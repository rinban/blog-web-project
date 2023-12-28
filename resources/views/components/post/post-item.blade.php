@props(['post'])
<article class="[&:not(:last-child)]:border-b border-gray-100 pb-10">
    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a wire:navigate href="{{route('posts.show', $post->slug)}}" >
                <img class="mw-100 mx-auto rounded-xl"
                    src="{{$post->getThumbnailUrl()}}"
                    alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                {{-- <img class="w-7 h-7 rounded-full mr-3"
                    src="{{$post->author->profile_photo_url}}"
                    alt="{{$post->author->name}}">
                <span class="mr-1 text-xs">{{$post->author->name}}</span> --}}
                <span class="text-gray-500 text-xs">{{$post->publish_at->diffForHumans()}}</span>
            </div> 
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{route('posts.show', $post->slug)}}" >
                    {{$post->title}}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{$post->getExcerpt()}}
            </p>
            <div class="flex items-center justify-start mt-6 article-actions-bar">
                <div class="flex gap-x-2">
                    @foreach ($post->tags as $tag)
                        <x-badge textColor="{{$tag->text_color}}" bgColor="{{$tag->bg_color}}" >
                            {{$tag->title}}
                        </x-badge>
                    @endforeach
                </div>
            </div>
            <div class="article-actions-bar mt-6 flex items-center justify-end">
                <div>
                   <livewire:like-button :key="$post->id" :$post />
                </div>
            </div>
        </div>
    </div>
</article>