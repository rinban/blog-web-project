@props(['post'])
<div>
    <a href="#">
        <div>
            <img class="w-full rounded-xl" src="{{$post -> getThumbnailUrl()}}">
        </div>
    </a>
    <div class="mt-3">
        <div class="flex items-center gap-2 mb-2">
            @if ($tag = $post->tags()->first())

                <x-badge textColor="{{$tag->text_color}}" bgColor="{{$tag->bg_color}}" >
                    {{$tag->title}}
                </x-badge>

            @endif
            <p class="text-gray-500 text-sm">{{$post->publish_at}}</p>
        </div>
        <a href="#" class="text-xl font-bold text-gray-900">{{$post->title}}</a>
    </div>
</div>