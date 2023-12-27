<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use function Pest\Laravel\post;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home',[
            'featuredPosts'=> Post::published()->featured()->latest('publish_at')->take(3)->get(),
            'latestPosts'=> Post::published()->latest('publish_at')->take(9)->get()
        ]);
    }
}
