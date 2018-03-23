<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as input;
use Auth;
use App\User;
use App\Uwdlog;
use App\Withdraw;
use App\Wdmethod;
use App\Gateway;
use App\Gsetting;
use App\Deposit;
use App\Charge;
use Carbon\Carbon;
use App\Reference;
use App\Upgrade;
use App\Avatar;
use App\Docver;
use App\Price;
use Session;
use Hash;
use App\Lib\GoogleAuthenticator;

use App\Lib\BlockKey;
use App\Lib\BlockIo;
use App\Useraddresses;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ckstatus');
    }

    public function index()
    {

        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        
		$currentRate = $res->USD->last;
		
		$price = Price::latest()->first();

        $btusd = Auth::user()->bitcoin * $currentRate;
        $nusd = Auth::user()->balance * $price->price;
        $totusd = $btusd + $nusd;

		$docverified = Auth::user()->docv;
		
        $allprice = Price::orderBy('id', 'ASC')->get();

        $gsettings = Gsetting::find(1);
		if(!is_null($gsettings)) {
			$apiKey = $gsettings->block_btc_api_key;
			$pin = $gsettings->block_secret_pin;
			$version = 2; // the API version
			$block_io = new BlockIo($apiKey, $pin, $version);
			
			$curr_user_id = Auth::id();
			$user_rec = DB::table('useraddresses')->where('user_id', $curr_user_id)->where('is_archived', '0')->first();
			$address = $address_label = '';
			$avl_btc_balance = 0;
			$avl_curr_balance = 0;
			if($user_rec) {
				$address = $user_rec->address;
				$address_label = $user_rec->address_label;
				$res = $block_io->get_address_balance(array('addresses' => $address));
				$arr_res = json_decode(json_encode($res), true);
				$curr_rate = number_format(floatval($currentRate) , $gsettings->decimalPoint, '.', '');
				
				if(isset($arr_res['status']) && strtolower($arr_res['status']) == "success") {
					if(isset($arr_res['data']['available_balance'])) {
						$avl_btc_balance = $arr_res['data']['available_balance'];
						$avl_curr_balance = $avl_btc_balance * $curr_rate;
					}
				}
			}			
			
		} else {
			$avl_btc_balance = $avl_curr_balance = number_format(floatval(0) , 5, '.', '');
			
		}
		
		return view('home',compact('currentRate','price','totusd','btusd','nusd','allprice', 'avl_btc_balance', 'avl_curr_balance', 'docverified'));
    }

    public function convert()
    {
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $currentRate = $res->USD->last;
        $price = Price::latest()->first();

        $btusd = Auth::user()->bitcoin * $currentRate;
        $nusd = Auth::user()->balance * $price->price;
        $totusd = $btusd + $nusd;

        return view('front.user.convert',compact('currentRate','price', 'btusd', 'nusd', 'totusd'));
    }

    public function transactions()
    {
        $trans = Uwdlog::where('user_id', Auth::user()->id )->orderBy('id', 'desc')->paginate(10);
        return view('front.user.trans',compact('trans'));
    }

	public function bittrans()
    {
        $trans = Uwdlog::where('user_id', Auth::user()->id )->orderBy('id', 'desc')->paginate(25);
        return view('front.user.bitlog',compact('trans'));
    }	
	
    public function bittransrcvd()
    {
        //$trans = Uwdlog::where('user_id', Auth::user()->id )->where('flag','0')->orderBy('id', 'desc')->paginate(10);
		
		$trans = array();
		$gsettings = Gsetting::first();
		if(!is_null($gsettings)) {
			$apiKey = $gsettings->block_btc_api_key;
			$pin = $gsettings->block_secret_pin;
			$version = 2; // the API version
			$block_io = new BlockIo($apiKey, $pin, $version);
			
			$curr_user_id = Auth::id();
			
			$user_recs = UserAddresses::where('user_id', '=', $curr_user_id)->orderBy('is_archived', 'desc')->get();
			foreach($user_recs as $user_rec) {
				//$user_rec = DB::table('useraddresses')->where('user_id', $curr_user_id)->where('is_archived', '0')->first();
				$address = $address_label = '';
				$avl_btc_balance = 0;
				$avl_curr_balance = 0;
				if($user_rec) {
					$address = $user_rec->address;
					$address_label = $user_rec->address_label;
					
					$transobj = $block_io->get_transactions(array('type' => 'received', 'addresses' => "{$address}"));
					if(!is_null($transobj)) {
						$arr_trans_list = json_decode(json_encode($transobj), true);
						if(isset($arr_trans_list['status']) && strtolower($arr_trans_list['status']) == "success") {
							$arr_trans = $arr_trans_list['data']['txs'];
							foreach($arr_trans as $tran){
								$obj_tran_dtl = new \stdClass();
								$obj_tran_dtl->status = 1;
								$obj_tran_dtl->toacc = $tran['senders'][0];
								$obj_tran_dtl->created_at = gmdate("Y-m-d H:i:s", $tran['time']);
								$obj_tran_dtl->amount = $tran['amounts_received'][0]['amount'];
								$trans[] = $obj_tran_dtl;
								$obj_tran_dtl = null;
							}
						}
					}
				}			
			}
		}
		
		
        return view('front.user.bitlogrcvd',compact('trans'));
    }

    public function cointrans()
    {
        $trans = Uwdlog::where('user_id', Auth::user()->id )->where('flag','1')->orderBy('id', 'desc')->paginate(10);
        return view('front.user.coinlog',compact('trans'));
    }

    public function userprofile()
    {
        $user = User::find(Auth::id());
        $avatar = Avatar::where('user_id', $user['id'] )->pluck('photo')->first();
        return view('front.user.profile', compact('user', 'avatar'));
    }

    public function cngavatar(Request $request)
    {
        $avatar = Avatar::where('user_id', Auth::id() )->first();

        if($avatar == null)
        {
            $this->validate($request, [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8000'
                        ]);

            if($request->hasFile('photo'))
                {
                    $newava['photo'] = Auth::id().'.png';
                    $request->photo->move('assets/images/avatar',$newava['photo']);
                }
            $newava['user_id'] = Auth::id();

            Avatar::create($newava);
            return back()->withSuccess('Your Photo Updated Successfuly!');
        }
        else
        {
            $this->validate($request, [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);

            if($request->hasFile('photo'))
                {
                    $avatar['photo'] = Auth::id().'.png';
                    $request->photo->move('assets/images/avatar',$avatar['photo']);
                }

            $avatar->save();

            return back()->withSuccess('Your Photo Updated Successfuly');

        }
    }

    public function userupdate(Request $request)
    {
        $user = User::find(Auth::id());

        $this->validate($request,
            [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',

            ]);

        $user['firstname'] = $request->firstname ;
        $user['lastname'] = $request->lastname ;
        $user['address'] = $request->address ;
        $user['city'] = $request->city ;
        $user['postcode'] = $request->postcode ;
        $user['country'] = $request->country ;
        $user['mobile'] = $request->mobile;

        $user->save();

        $msg =  'User Information Updated';
        send_email($user->email, $user->username, 'Info Updated', $msg);
        $sms =  'User Information Updated';
        send_sms($user->mobile, $sms);

        return back()->withSuccess('Profile Information Updated Successfuly');

    }

    //Documnet Verify
    public function document()
    {
      return view('front.user.document');  
    }

    public function doc_verify(Request $request)
    {        
        $this->validate($request, 
            [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
            ]);

        $docm['user_id'] = Auth::id();
        $docm['name'] = $request->name;
        $docm['details'] = $request->details;
        if($request->hasFile('photo'))
            {
                $docm['photo'] = uniqid().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move('assets/images/document',$docm['photo']);
            }

        Docver::create($docm);

        return back()->withSuccess('Verification Request Sent Successfuly!'); 

    }

    //Change password
    public function changepass()
    {
        $user = User::find(Auth::id());
        $avatar = Avatar::where('user_id', $user['id'] )->pluck('photo')->first();
        return view('auth.chpass', compact('user','avatar'));
    }

    public function chnpass()
    {
      $user = User::find(Auth::user()->id);

      if(Hash::check(Input::get('passwordold'), $user['password']) && Input::get('password') == Input::get('password_confirmation'))
      {
        $user->password = bcrypt(Input::get('password'));
        $user->save();

        $msg =  'Password Changed Successfully';
        send_email($user->email, $user->username, 'Password Changed', $msg);
        $sms =  'Password Changed Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Password Changed');
      }
      else 
      {
          return back()->with('alert', 'Password Not Changed');
      }
    }


public function deposit()
    {
        $all = file_get_contents("https://blockchain.info/ticker");
        $res = json_decode($all);
        $currentRate = $res->USD->last;
        $price = Price::latest()->first();

        $btusd = Auth::user()->bitcoin * $currentRate;
        $nusd = Auth::user()->balance * $price->price;
        $totusd = $btusd + $nusd;
        return view('front.user.deposit', compact('btusd','nusd','totusd'));
    }

    public function refered()
    {
        $user = User::find(Auth::User()->id);
        $refers = User::where('refid', $user['id'] )->orderBy('id', 'desc')->get();
        $today = Reference::where('refer', $user['username'] )->whereDate('created_at', Carbon::today()->toDateString())->get();
        return view('front.user.refered', compact('refers','today'));
    }

    public function google2fa()
    {
        $ga = new GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl(Auth::user()->email, $secret);

        $prevcode = Auth::user()->secretcode;
        $prevqr = $ga->getQRCodeGoogleUrl(Auth::user()->email, $prevcode);

        return view('front.user.goauth.create', compact('secret','qrCodeUrl','prevcode','prevqr'));

    }

    public function create2fa(Request $request)
    {
        $user = User::find(Auth::id());
        
        $this->validate($request,
            [
                'key' => 'required',
            ]);

        $user['secretcode'] = $request->key;
        $user['gtfa'] = 1;
        $user['tfav'] = 1;
        $user->save();

        $msg =  'Google Two Factor Authentication Enabled Successfully';
        send_email($user->email, $user->username, 'Google 2FA', $msg);
        $sms =  'Google Two Factor Authentication Enabled Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Google Authenticator Enabeled Successfully');
    }

    public function disable2fa()
    {
        $user = User::find(Auth::id());
        $user['gtfa'] = 0;
        $user['tfav'] = 1;
        $user['secretcode'] = '0';
        $user->save();

        $msg =  'Google Two Factor Authentication Disabled Successfully';
        send_email($user->email, $user->username, 'Google 2FA', $msg);
        $sms =  'Google Two Factor Authentication Disabled Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Two Factor Authenticator Disable Successfully');
    }



}
