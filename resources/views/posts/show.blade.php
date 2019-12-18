@extends('layouts.app')

@section('content')
{{--    {{dd('dick')}}--}}
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
{{--                        <div class="pr-3">--}}
{{--                            <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">--}}
{{--                        </div>--}}
                         <div class="font-weight-bold">
                            <a href="/profile/{{ $post->profile->user_id }}">
                                <span class="text-dark">{{ $post->profile->user->login }}</span>
                            </a>
                            <a href="#" class="pl-3">Follow</a>

                            @can('forceDelete', $post)
                                <form action="{{route('post.destroy',['post' => $post->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary">Delete Post</button>
                                </form>
                            @endcan
                         </div>
{{--                         <div>--}}
{{--                             <form action="{{route('post.edit',['post' => $post->id])}}" method="get">--}}
{{--                                 @csrf--}}
{{--                                  <button class="btn btn-primary">Allow Comments</button>--}}
{{--                             </form>--}}
{{--                         </div>--}}
                     </div>
                    <hr>
{{--                    <ul>--}}
{{--                        @foreach($post->comments as $comment)--}}
{{--                            <li>{{$comment->body}}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
                    <comment-post user-id="{{$user->id}}" post-id="{{ $post->id }}" user-login="{{$user->login}}" comment-status='@json($post->allow_comments)'></comment-post>

{{--                    <form action="/comment" method="post">--}}
{{--                        @csrf--}}
{{--                        <textarea name="body"></textarea>--}}
{{--                        <input name="post_id" value="{{$post->id}}">--}}
{{--                        <input name="user_id" value="{{$user->id}}">--}}
{{--                        <input type="submit">--}}
{{--                    </form>--}}
                    <p>
{{--                    <span class="font-weight-bold">--}}
{{--                        <a href="/profile/{{ $post->user->id }}">--}}
{{--                            <span class="text-dark">{{ $post->user->username }}</span>--}}
{{--                        </a>--}}
{{--                    </span> {{ $post->caption }}--}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

