<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uaccount;
use App\Gsetting;
use App\User;
use App\Uwdlog;
use App\Charge;
use App\Tranlimit;
use App\Withdraw;
use App\Price;
use Auth;

use App\Lib\BlockKey;
use App\Lib\BlockIo;
use App\Useraddresses;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UaccountController extends Controller
{
	
	public function requestMoney() {
		$gset = Gsetting::first();
		$curr_user_id = Auth::id();
		
		$user_rec = DB::table('useraddresses')->where('user_id', $curr_user_id)->where('is_archived', '0')->first();
		$address = $address_label = '';
		if($user_rec) {
			$address = $user_rec->address;
			$address_label = $user_rec->address_label;
		}

        if($address)
        {
			$var = $gset->curCode.":".$address;
			$uac['user_id'] = Auth::id();
			$uac['accnum'] = $address;
			$uac['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";

			return $uac;
		}
	    else
	    {
			$err = "Please Reload The Page";
			return $err;
	    }		
	}
	
	public function requestMoneyOld()
    {
        $gset = Gsetting::first();

            $uac['user_id'] = Auth::id();
            $uac['accnum'] = str_random(32);
            $new_account = Uaccount::create($uac);

            if($new_account)
            {

                $var = $gset->curCode.":".$uac['accnum'];
                $uac['code'] =  "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";

                return $uac;
            }
           else
           {
                $err = "Please Reload The Page";
                return $err;
           }

    }

	public function sendMoney(Request $request) {
		$this->validate($request,
			[
				'amount' => 'required',
				'curn' => 'required',
				'code' => 'required',
			]);
		$trf_amount = $request->amount;
		$rcvr_address = $request->code;
		$curr_code = $request->curn;
		$notes = $request->desc;
		
		$sender = User::find(Auth::id());
		
		try {
			$curr_user_id = Auth::id();		
			$user_rec = DB::table('useraddresses')->where('user_id', $curr_user_id)->where('is_archived', '0')->first();
			if(!is_null($user_rec)) {
				$sender_address = $user_rec->address;
				$sender_address_label = $user_rec->address_label;
				
				$gsettings = Gsetting::first();
				$conversion_charge = $gsettings->convertion_charge;
				Log::info("Conversion charge:" . $conversion_charge);
				$apiKey = $gsettings->block_btc_api_key;
				$pin = $gsettings->block_secret_pin;
				$version = 2; // the API version
				$block_io = new BlockIo($apiKey, $pin, $version);
				
				$admin_rcvg_address = $gsettings->block_admin_rcvg_address;
				
				$res = $block_io->get_address_balance(array('addresses' => $sender_address));
				$arr_res = json_decode(json_encode($res), true);
				$sender_avl_btc_balance = $arr_res['data']['available_balance'];
				
				$res_rcvr = $block_io->get_address_balance(array('addresses' => $rcvr_address));
				if(!is_null($res_rcvr)) {
					$arr_res_rcvr = json_decode(json_encode($res_rcvr), true);
					$rcvr_avl_btc_balance = $arr_res_rcvr['data']['available_balance'];
				} else {
					return back()->with('alert', 'Invalid Receiver Wallet Address');  
				}
				$commission = number_format(($conversion_charge * $trf_amount /100), $gsettings->decimalPoint, '.', '');
				$total_amount = number_format(($trf_amount + $commission), $gsettings->decimalPoint, '.', '');
				Log::info("commission:" . $commission . "trf_amount:" . $trf_amount . ", total amt:" . $total_amount . ", decimals:" . $gsettings->decimalPoint);
				$feeobj = $block_io->get_network_fee_estimate(array('amounts' => "{$total_amount}", 'to_addresses' => "{$rcvr_address}"));
				$arr_feeobj = json_decode(json_encode($feeobj), true);
				$network_fee_estimate = 0.00;
				if(isset($arr_feeobj['status']) && (strtolower($arr_feeobj['status']) == "success")) {
					$network_fee_estimate = $arr_feeobj['data']['estimated_network_fee'];
				}
				Log::info("network fee estimate:" . $network_fee_estimate);
				$total_charges = number_format(($commission + $network_fee_estimate),$gsettings->decimalPoint, '.', '');
				$total_withdrawal_amt = number_format(($total_charges + $trf_amount), $gsettings->decimalPoint, '.', '');
				if($sender_avl_btc_balance < $total_charges) {
					return back()->with('alert', 'Insufficient Balance');
				}
				
				$trf_amt_formatted = number_format($trf_amount, $gsettings->decimalPoint, '.', '');
				if($commission < 0.00001) $commission = "0.00001";
				Log::info("commission= $commission");
				if($commission) {
					Log::info("sending {$trf_amt_formatted} to {$rcvr_address}, and, {$commission} to {$admin_rcvg_address} from {$sender_address}");
					$trf_res = $block_io->withdraw_from_addresses(array('amounts' => "{$trf_amt_formatted},{$commission}" , 'from_addresses' => "{$sender_address},{$sender_address}", 'to_addresses' => "{$rcvr_address},{$admin_rcvg_address}"));
				} else {
					$trf_res = $block_io->withdraw_from_addresses(array('amounts' => "{$trf_amt_formatted}" , 'from_addresses' => "{$sender_address}", 'to_addresses' => "{$rcvr_address}"));
				}
				
				$arr_trf_res = array();
				if(!is_null($trf_res)) {
					$arr_trf_res = json_decode(json_encode($trf_res), true);
					//Log::info("transfer result:" . print_r($arr_trf_res, true));
					send_email($sender->email, $sender->username, 'Sent BitCoin', 'Bitcoin transfer was successful');
					
					////////////////////record transactuion details to DB ////////////////
					//fetch current balance of sender
					$bal_res = $block_io->get_address_balance(array('addresses' => $sender_address));
					$sender_balance = 0;
					if(!is_null($bal_res)) {
						$bal_arr = json_decode(json_encode($bal_res), true);
						if(isset($bal_arr['status']) && strtolower($bal_arr['status']) == "success") {
							$sender_balance = $bal_arr['data']['available_balance'];
						}					
					}
					$rlog['user_id'] =  $curr_user_id;
					$rlog['trxid'] = isset($arr_trf_res['data']['txid']) ? $arr_trf_res['data']['txid']: "";
					$rlog['toacc'] = $rcvr_address;
					$rlog['amount'] = $trf_amt_formatted;
					$rlog['charge'] = isset($arr_trf_res['data']['network_fee']) ? $arr_trf_res['data']['network_fee']: '0';
					$rlog['blockio_fee'] = isset($arr_trf_res['data']['blockio_fee']) ? $arr_trf_res['data']['blockio_fee']: '0';
					$rlog['commission'] = $commission;
					$rlog['flag'] = 0;
					$rlog['status'] = 0; //1 for received, 0 for sent
					$rlog['balance'] = $sender_balance;
					$rlog['desc'] = $notes;
					
					$ret = Uwdlog::create($rlog);					
					
					/////////////////////////////////////////////////////////////////////////////
					
					
					return redirect()->route('home')->withSuccess('BitCoin Sent Successfuly');
				} else {
					return back()->with('alert', 'Transaction could not be completed');
				}
			} else {
				return back()->with('alert', 'Invalid Wallet Address');
			}
		} catch(\Exception $e) {
			return back()->with('alert', 'Exception occurred.' . $e->getMessage());  
		}
	}
	
    public function sendMoneyOld(Request $request)
    {
         $this->validate($request,
            [
                'amount' => 'required',
                'curn' => 'required',
                'code' => 'required',
            ]);
        $sender = User::find(Auth::id());
        $charge = Charge::first();
        $tnchrg = $charge->trancharge + ($request->amount*$charge->trncrgp)/100;
        $tamount = $request->amount + $tnchrg;

        if ($request->curn == '1') 
            {
                if($sender->balance < $tamount ||  $request->amount <= 0)
                {
                    return back()->with('alert', 'Insufficient Balance');
                }
                else
                {
                    $code = Uaccount::where('accnum',$request->code)->first();
                
                    if($code == null)
                    {
                      return back()->with('alert', 'Invalid Wallet Address');  
                    }
                    else
                    {
                        $reciver = User::findOrFail($code->user_id);
                        $reciver['balance'] =  $reciver['balance'] + $request->amount;
                        $reciver->save();

                        $rlog['user_id'] =  $reciver['id'];
                        $rlog['trxid'] = str_random(40);
                        $rlog['toacc'] = $request->code;
                        $rlog['amount'] = $request->amount;
                        $rlog['charge'] = '0';
                        $rlog['flag'] = 1;
                        $rlog['status'] = 1;
                        $rlog['balance'] = $reciver['balance'];
                        $rlog['desc'] = 'Recived Coin';
                        Uwdlog::create($rlog);

                        $sender['balance'] =  $sender['balance'] - $tamount;
                        $sender->save();

                        $slog['user_id'] =  $sender['id'];
                        $slog['trxid'] = str_random(40);
                        $slog['toacc'] = $request->code;
                        $slog['amount'] = $request->amount;
                        $slog['charge'] = $tnchrg;
                        $slog['flag'] = 1;
                        $slog['status'] = 0;
                        $slog['balance'] = $sender['balance'];
                        $slog['desc'] = 'Sent Coin';
                        Uwdlog::create($slog);

                        $msg =  'Recived Coin from '.$sender->username;
                        send_email($reciver->email, $reciver->username, 'Recived Coin', $msg);
                        $sms =  'Recived Coin from '.$sender->username;
                        send_sms($reciver->mobile, $sms);

                        $msg =  'Sent Coin To '.$reciver->username;
                        send_email($sender->email, $sender->username, 'Sent Coin', $msg);
                        $sms =  'Sent Coin To '.$reciver->username;
                        send_sms($sender->mobile, $sms);

                         return redirect()->route('home')->withSuccess('Coin Sent Successfuly');
                    
                    }

                }
            }
            else
            {
                 if($sender->bitcoin < $tamount ||  $request->amount <= 0)
                {
                    return back()->with('alert', 'Insufficient Balance');
                }
                else
                {
                        $withdraw['wdid'] = $request->code;
                        $withdraw['user_id'] = Auth::id();
                        $withdraw['amount'] = $request->amount;
                        $withdraw['charge'] = $tnchrg;
                        $withdraw['wdmethod_id'] = $request->curn;
                        $withdraw['details'] = $request->desc;
                        $withdraw['status'] = 0;

                        Withdraw::create($withdraw);

                        $sender['bitcoin'] =  $sender['bitcoin'] - $tamount;
                        $sender->save();

                        $slog['user_id'] =  $sender['id'];
                        $slog['trxid'] = str_random(40);
                        $slog['toacc'] = $request->code;
                        $slog['amount'] = $request->amount;
                        $slog['charge'] = $tnchrg;
                        $slog['flag'] = 0;
                        $slog['status'] = 0;
                        $slog['balance'] = $sender['bitcoin'];
                        $slog['desc'] = 'Sent BitCoin';
                        Uwdlog::create($slog);

                        $msg =  'Sent BitCoin';
                        send_email($sender->email, $sender->username, 'Sent BitCoin', $msg);
                        $sms =  'Sent BitCoin';
                        send_sms($sender->mobile, $sms);

                    return redirect()->route('home')->withSuccess('BitCoin Sent Successfuly');
                }

            }
    }

    public function convertMoney(Request $request)
    {
        $this->validate($request,
            [
                'framo' => 'required',
                'fromc' => 'required',
            ]);

        $user = User::find(Auth::id());
        $tlimit = Tranlimit::first();
        $charge = Charge::first();
        $gset = Gsetting::first();

        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcRate = $res->USD->last;
        $cprice = Price::latest()->first();
        $ucode = Uaccount::where('user_id',Auth::id())->first();

        if ($ucode == null)
        {
            $uac['user_id'] = Auth::id();
            $uac['accnum'] = str_random(32);
            $new_account = Uaccount::create($uac);
            $ucode = Uaccount::where('user_id',Auth::id())->first();
        }

        if ($request->fromc == '1') 
        {
            $concrg = ($charge->convcrg * $request->framo)/100;
            $balance = $user->balance - $concrg;

            if ($user->docv != '1' && $request->framo >  $tlimit->coin) 
            {
                return back()->with('alert', 'Please Verify Your Document to Convert Money');
            }
            elseif($request->framo > $balance ||  $request->framo <= 0)
            {
                return back()->with('alert', 'Insufficient Balance');
            }
            else
            {
                $user['balance'] = $user->balance - ($request->framo + $concrg);
                $btc = ($request->framo*$cprice->price)/$btcRate;
                $user['bitcoin'] = $user['bitcoin'] + $btc;
                $user->save();

                $clog['user_id'] = Auth::id();
                $clog['trxid'] = str_random(40);
                $clog['amount'] = $request->framo;
                $clog['charge'] = $concrg;
                $clog['toacc'] = $ucode->accnum;
                $clog['flag'] = 1;
                $clog['status'] = 0;
                $clog['balance'] = $user['balance'];
                $clog['desc'] = 'Coverted to BitCoin';
                Uwdlog::create($clog);

                $rlog['user_id'] = Auth::id();
                $rlog['trxid'] = str_random(40);
                $rlog['amount'] = $btc;
                $rlog['charge'] = 0;
                $rlog['toacc'] = $ucode->accnum;
                $rlog['flag'] = 0;
                $rlog['status'] = 1;
                $rlog['balance'] = $user['bitcoin'];
                $rlog['desc'] = 'Coverted to BitCoin';
                Uwdlog::create($rlog);

                $msg =  'Coin Converted to BitCoin';
                send_email($user->email, $user->username, 'Converted to BitCoin', $msg);
                $sms =  'Coin Converted to BitCoin';
                send_sms($user->mobile, $sms);

                return back()->with('success', 'Converted to BitCoin Successfully');
            }
        }
        else
        {
            $concrg = ($charge->convcrg*$request->framo)/100;
            $bitcoin = $user->bitcoin - $concrg;

            if ($user->docv != '1' && $request->framo >  $tlimit->coin) 
            {
                return back()->with('alert', 'Please Verify Your Document to Convert Money');
            }
            elseif($request->framo > $bitcoin || $request->framo <= 0)
            {
                return back()->with('alert', 'Insufficient Balance');
            }
            else
            {
                $user['bitcoin'] = $user->bitcoin - ($request->framo + $concrg);
                $baln = ($request->framo*$btcRate)/$cprice->price;
                $user['balance'] = $user['balance'] + $baln;
                $user->save();

               $clog['user_id'] = Auth::id();
                $clog['trxid'] = str_random(40);
                $clog['amount'] = $request->framo;
                $clog['charge'] = $concrg;
                $clog['toacc'] = $ucode->accnum;
                $clog['flag'] = 0;
                $clog['status'] = 0;
                $clog['balance'] = $user['bitcoin'];
                $clog['desc'] = 'Coverted From BitCoin';
                Uwdlog::create($clog);

                $rlog['user_id'] = Auth::id();
                $rlog['trxid'] = str_random(40);
                $rlog['amount'] = $baln;
                $rlog['charge'] = 0;
                $rlog['toacc'] = $ucode->accnum;
                $rlog['flag'] = 1;
                $rlog['status'] = 1;
                $rlog['balance'] = $user['balance'];
                $rlog['desc'] = 'Coverted to BitCoin';
                Uwdlog::create($rlog);

                $msg =  'BitCoin Converted to Coin';
                send_email($user->email, $user->username, 'Converted to Coin', $msg);
                $sms =  'BitCoin Converted to Coin';
                send_sms($user->mobile, $sms);

                return back()->with('success', 'Converted from BitCoin Successfully');
            }   
        }
    }

    public function sellcoin()
    {
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $currentRate = $res->USD->last;
        $price = Price::latest()->first();

        $btusd = Auth::user()->bitcoin * $currentRate;
        $nusd = Auth::user()->balance * $price->price;
        $totusd = $btusd + $nusd;

        return view('front.user.sell' , compact('btusd','nusd','totusd'));
    }

    public function sellview(Request $request)
    {
        $this->validate($request,
            [
                'amount' => 'required',
            ]);
        if ($request->amount <= 0) 
         {
             return redirect()->route('sell.coin')->with('alert', 'Invalid Amount');
         }
         else
         {

            $all = file_get_contents("https://blockchain.info/ticker");
            $res = json_decode($all);
            $btcRate = $res->USD->last;
            $cprice = Price::latest()->first();
            $amount = $request->amount;
            $btc = ($request->amount*$cprice->price)/$btcRate;

            return view('front.user.sellview', compact('btc','amount'));
        }
    }

    public function sellconfirm(Request $request)
     {
        $this->validate($request,
            [
                'amount' => 'required',
            ]);
        
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $btcRate = $res->USD->last;
        $cprice = Price::latest()->first();

        $user = User::find(Auth::id());
        $tlimit = Tranlimit::first();
        $charge = Charge::first();
        $concrg = ($charge->convcrg * $request->framo)/100;
        $balance = $user->balance - $concrg;

        $ucode = Uaccount::where('user_id',Auth::id())->first();

        if ($ucode == null)
        {
            $uac['user_id'] = Auth::id();
            $uac['accnum'] = str_random(32);
            $new_account = Uaccount::create($uac);
            $ucode = Uaccount::where('user_id',Auth::id())->first();
        }

        if ($user->docv != '1' && $request->amount >  $tlimit->coin) 
            {
                return redirect('home')->with('alert', 'Please Verify Your Document to Sell Coin');
            }
            elseif($request->amount > $balance || $request->amount <= 0)
            {
                return redirect('home')->with('alert', 'Insufficient Balance');
            }
            else
            {
                $user['balance'] = $user->balance - ($request->amount + $concrg);
                $btc = ($request->amount*$cprice->price)/$btcRate;
                $user['bitcoin'] = $user['bitcoin'] + $btc;
                $user->save();

                $clog['user_id'] = Auth::id();
                $clog['trxid'] = str_random(40);
                $clog['amount'] = $request->amount;
                $clog['charge'] = $concrg;
                $clog['toacc'] = $ucode->accnum;
                $clog['flag'] = 1;
                $clog['status'] = 0;
                $clog['balance'] = $user['balance'];
                $clog['desc'] = 'Sold Coin';
                Uwdlog::create($clog);

                $rlog['user_id'] = Auth::id();
                $rlog['trxid'] = str_random(40);
                $rlog['amount'] = $btc;
                $rlog['charge'] = 0;
                $rlog['toacc'] = $ucode->accnum;
                $rlog['flag'] = 0;
                $rlog['status'] = 1;
                $rlog['balance'] = $user['bitcoin'];
                $rlog['desc'] = 'Bought BitCoin';
                Uwdlog::create($rlog);

                $msg =  'Coin Sold Successfully';
                send_email($user->email, $user->username, 'Coin Sold', $msg);
                $sms =  'Coin Sold Successfully';
                send_sms($user->mobile, $sms);

                return redirect('home')->with('success', 'Coin Sold Successfully');
            }
     }  
}

