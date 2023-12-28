@props(['author'])
<img class="w-7 h-7 rounded-full mr-3"
                    src="{{$author->profile_photo_url?? 'none'}}"
                    alt="{{$author->name?? 'none'}}">
<span class="mr-1 text-xs">{{$author->name?? 'none'}}</span> 