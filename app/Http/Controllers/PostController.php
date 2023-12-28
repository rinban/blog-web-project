<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'tags' => Tag::
            whereHas('posts',function($query){
                $query->published();
            })->take(10)->get()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', 
            [
                'post' => $post

            ]
        );
    }
}
