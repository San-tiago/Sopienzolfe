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
        $user = DB::table('users')->where('email',$email)->first();
       
       
         $useracc = User::firstorNew([   
            'name' => $usergmail->getname(),
           'email' => $usergmail->getemail(),
            'provider_id' => $usergmail->getid()
        ]);
        
        // $user->token;
       
        
        if(!$user){
            $userdetails = [   
           'name' => $name,
            'email' => $email
        ];
            //user is not found 
            return view('/info', $userdetails);
     }
     if($user){
            // user found 
        Auth::Login($useracc,true);
        return redirect('/home');
     }
        
    }

}
