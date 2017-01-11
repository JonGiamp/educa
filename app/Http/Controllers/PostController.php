<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{ 
    
    public function viewAll() {
        $posts = \App\Post::all();
        return view('posts', ['posts'=>$posts]);
    }
    
    public function viewOne($id) {
        $post = \App\Post::where('id', $id)->get();
        $comments = \App\Comments::where('id_posts', $id)->orderBy('date', 'desc')->get();
        return view('post', ['$post'=>$post, '$comments'=>$comments]);
    }
    
}