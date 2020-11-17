<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use DB;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

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

    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {   // add lang pala yung stateless chuchu inamyan
        $usergmail = Socialite::driver('google')->stateless()->user();
        $name = $usergmail->getname();
        $email = $usergmail->getemail();
        //dd($usergmail);
       // $address = null;
       /*  $user = DB::table('users')->where('email',$email)->first(); */
        //$user_address = DB::table('users')->where('address',$address)->first();
       
        $check_user = User::where('email','=',$email)->first();

         /* $user_check = User::firstorNew([   
            'name' => $usergmail->getname(),
           'email' => $usergmail->getemail(),
            'provider_id' => $usergmail->getid()
        ]); */
        
      /*   $user_check = User::firstorCreate([   
            'name' => $usergmail->getname(),
           'email' => $usergmail->getemail(),
            'provider_id' => $usergmail->getid()
        ]); */
        // $user->token;
       
        
        if($check_user === null){
            
            //user is not found 
            echo "user not found";
                }
    else{ 
        Auth::Login($check_user,true);
        return redirect('/home');
     }
            // user found 
       
        
    }

}
