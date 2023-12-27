<?php

namespace App\View\Components\Post;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.post-card');
    }
}
