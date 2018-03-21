<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Gsetting;
use App\User;
use App\Useraddresses;

use App\Lib\BlockKey;
use App\Lib\BlockIo;
use Illuminate\Support\Facades\Log;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',            
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            //'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            //'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		$gset = Gsetting::first();
		
		$ret = User::create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    //'city' => $data['city'],
                    'country' => $data['country'],
                    //'mobile' => $data['mobile'],
                    'balance' => '00',
                    'status' => 1,
                    'bitcoin' => '00',
                    'docv' => 0,
                    'gtfa' => 0,
                    'tfav' => 1,
                    'emailv' =>  $gset->emailVerify,
                    'smsv' =>  $gset->smsVerify,
            ]);
		
		$user_id = $ret->id; //new user id
		
		$gsettings = Gsetting::find(1);
		$user_btc_address = "";
		if(!is_null($gsettings)) {
			$apiKey = $gsettings->block_btc_api_key;
			$pin = $gsettings->block_secret_pin;
			$version = 2; // the API version
			$block_io = new BlockIo($apiKey, $pin, $version);
			
			$address_label = uniqid($data['username'] . "_");
			$res = $block_io->get_new_address(array('label' => $address_label));
			$arr_res = json_decode(json_encode($res), true);
			//Log::info("address:" . print_r($arr_res, true));
			if(isset($arr_res['status']) && (strtolower($arr_res['status']) == "success")) {
				if(isset($arr_res['data']['address']) && $arr_res['data']['address']) {
					$user_btc_address = $arr_res['data']['address'];
					$uaret = Useraddresses::create([
						'user_id' => $user_id,
						'address' => $user_btc_address,
						'address_label' => $address_label,
						'is_archived' => 0
					]);
					//Log::info("address-db:" . print_r($uaret, true));
				}
			}
		}
		
              
			return $ret;


    }
}
