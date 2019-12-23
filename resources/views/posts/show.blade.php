@extends('layouts.app')

@section('content')
     <div class="container">
        <div class="row">
            <div class="col-8">
                <a href="{{route('profile.show',['profile' =>$post->user->id])}}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
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
                     </div>
                    <hr>
                    <comment-post user-id="{{$user->id}}" post-id="{{ $post->id }}" user-login="{{$user->login}}" comment-status='@json($post->allow_comments)'></comment-post>
                    <br>
                    <like-post
                        post-id="{{$post->id}}"
                        users-that-liked-me = "{{$post->usersThatLikedMeCount}}"
                    >
                    </like-post>

                </div>
            </div>
        </div>
    </div>
@endsection

