<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\CommentsRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Comments;

class RequestController extends Controller
{
  public function post_comments(CommentsRequest $request) {
    $Comments = new Comments;
    $Comments->id_user = $request->id_user;
    $Comments->user_name = $request->user_name;
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
    Mail::to('administrateur@chezmoi.com')
            ->send(new Contact($request->except('_token')));
    return view('pages/contact');
  }

}
