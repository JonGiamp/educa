<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\CommentsRequest;
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\Contact;
use App\Comments;
use App\Users;

class RequestController extends Controller
{
  public function post_comments(CommentsRequest $request) {
    // We create a new comment
    $Comments = new Comments;
    $Comments->id_user = Auth::user()->id;
    $Comments->user_name = Auth::user()->name;
    $Comments->id_game = $request->id_game;
    $Comments->game_name = $request->game_name;
    $Comments->game_picture = $request->game_picture;
    $Comments->comment = $request->comment;
    $Comments->url_emote = $request->url_emote;
    $Comments->date = date('Y-m-d');
    $Comments->save();

    return redirect()->route('options');
  }

  public function post_contact(ContactRequest $request) {
    Mail::to('contacteduca@gmail.com')
            ->send(new Contact($request->except('_token')));
    return view('pages/contact');
  }

  public function put_settings(SettingsRequest $request) {
      // We load user database informations
      $user = Users::find(Auth::user()->id);
      $need_logout = false;

      // We test old password and check the new
      // if it's ok, we encrypte and save the new password
      if( Hash::check($request->password, $user->password)
        && ($request->new_password == $request->new_password_confirmation) ) {
          $user->password = Hash::make($request->new_password);
          $need_logout = true;
        }

      // We check if email have change. If he's change, we save the new
      if($request->email != $user->email) {
        $user->email = $request->email;
        $need_logout = true;
      }

      // Same as email
      if($request->years != $user->years)
        $user->years = $request->years;

      // We save the change
      $user->save();

      // If email or pwd has change, we logout the user
      if($need_logout) {
        Auth::logout();
        return redirect()->route('connexion');
      }
      return redirect()->route('options');
  }

}
