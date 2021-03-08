<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class AccountController extends Controller
{
    //
    public function account_settings(){
        $user_id = Auth::user()->id;
        $user_details = User::where('id',$user_id)->get();

        return view('AccountSettings.accountsettings',compact('user_details'));
    }
    public function edit_accountdetails(Request $request){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->update($request->all());
        return redirect('/account-settings');
    }


}
