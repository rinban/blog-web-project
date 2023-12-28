<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search = '';

    #[Url()]
    public $tag = '';

    public function setSort($sort){
        $this->sort = ($sort === 'desc')? 'desc' : 'asc';
        $this->resetPage();
    }

    #[On('search')]
    public function updateSearch($search){
        $this->search=$search;
    }

    #[Computed()]
    public function posts(){
        return Post::published()
            ->orderBy('publish_at',$this->sort)
            ->when(Tag::where('slug',$this->tag)->first(), function($query){
                $query->withTag($this->tag);
            })
            ->where('title','like',"%{$this->search}%")
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
