<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">
            @if ($search)
                Searching Keyword: {{$search}}
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button class="{{$sort === 'desc' ? 'text-yellow-500 border-b border-yellow-600' : 'text-gray-500'}} py-4" 
                wire:click="setSort('desc')">Latest</button>
            <button class="{{$sort === 'asc' ? 'text-yellow-500 border-b border-yellow-600' : 'text-gray-500'}} py-4"
                wire:click="setSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-post.post-item :post="$post"/>
        @endforeach
    </div>
    <div class="my-3">
        {{$this->posts->onEachSide(1)->links()}}
    </div>
</div>
