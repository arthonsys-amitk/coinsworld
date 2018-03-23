<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

use App\Gsetting;
use App\Useraddresses;
use App\Lib\BlockKey;
use App\Lib\BlockIo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoginController extends Controller
{


     public function postLogin(Request $request)
    {

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
                    ]))
         {

            $logg = User::findOrFail(Auth::user()->id);

            if(Auth::user()->gtfa==1){
                $logg['tfav'] = 0;
            }else{
                $logg['tfav'] = 1;

            }
            $logg->save();
			
			$this->checkWalletExpiry();
			
            return redirect('/home');

        }

        $request->session()->flash('alert', 'Login  incorrect!');
        return redirect()->back();
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function checkWalletExpiry() {
		$gsettings = Gsetting::first();
		if(!is_null($gsettings)) {
			$wallet_duration_days = $gsettings->wallet_duration_days;
			try {
				if($wallet_duration_days) {
					$user_rec = DB::table('useraddresses')->where('user_id', Auth::user()->id)->where('is_archived', '0')->first();
					if(!is_null($user_rec)) {
						$old_address = $user_rec->address;
						Log::info("old_address: $old_address");
						$addr_created_at = $user_rec->created_at;
						$created = new Carbon($addr_created_at);
						$now = \Carbon::now();
						$difference = $created->diff($now)->days; //diff in days
						Log::info("difference days: $difference, wallet days: $wallet_duration_days");
						if($difference >= $wallet_duration_days){
							//create new address
							$apiKey = $gsettings->block_btc_api_key;
							$pin = $gsettings->block_secret_pin;
							$version = 2; // the API version
							$block_io = new BlockIo($apiKey, $pin, $version);
							$address_label = uniqid(Auth::user()->username . "_");
							$res = $block_io->get_new_address(array('label' => $address_label));
							$arr_res = json_decode(json_encode($res), true);
							if(isset($arr_res['status']) && (strtolower($arr_res['status']) == "success")) {
								if(isset($arr_res['data']['address']) && $arr_res['data']['address']) {
									$user_btc_address = $arr_res['data']['address'];
									$uaret = Useraddresses::create([
										'user_id' => Auth::user()->id,
										'address' => $user_btc_address,
										'address_label' => $address_label,
										'is_archived' => 0
									]);
									
									if(!is_null($uaret) && $uaret) {
										//archive record in DB
										$user_arc = Useraddresses::where('address', '=', $old_address);
										$user_arc->update(array('is_archived' => 1));
										
										//archive the address using api
										$res_arc = $block_io->archive_address(array('addresses' => "{$old_address}"));
										Log::info("old address - $old_address - archived");
										Log::info("new address created:" . $user_btc_address);
										
										$msg =  "Wallet address: $old_address has been archived for security. You new Wallet address is now: $user_btc_address";
										send_email(Auth::user()->email, Auth::user()->username, 'Wallet Address Updated', $msg);
									}
								}
							}
						}
					}
				}
			} catch(\Exception $e) {
				Log::info("Exception occurred." . $e->getMessage());
				return back()->with('alert', 'Exception occurred' . $e->getMessage());
			}
		}
	}
}
