<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Auth;
use DB;
class AccountController extends Controller
{
    //
    public function account_settings(Request $request){
        $uri = request()->segment(1);

        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $user_details = User::where('id',$user_id)->get();
        $decline_messages_count = Message::where([
            'to_useremail'=> $user_email,
            'read_at'=> 0
            ])->count();
        $message_count = db::table('messages')->where([
                'seen'=> 0,
                'from_id' => 1
                ])->count();
        $decline_messages = Message::where('to_useremail',$user_email)->get();
        return view('AccountSettings.accountsettings',compact('user_details','decline_messages_count','decline_messages','message_count','uri'));
    }
    public function edit_accountdetails(Request $request){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->update($request->all());
        return redirect('/account-settings');
    }


}
