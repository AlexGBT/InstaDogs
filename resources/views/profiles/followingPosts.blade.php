@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($followingPosts as $post)
        <div class="row">
            <div class="col-7">

                <img src="/storage/{{ $post->image }}" class="w-75">
            </div>
            <div class="col-5">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="font-weight-bold">
                            <a href="/profile/{{ $post->profile->user_id }}">
                                <span class="text-dark">{{ $post->profile->user->login }}</span>
                            </a>
                            <p> Description: {{$post->description}}</p>
                            <p>Published {{$post->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                    <hr>
                    <comment-post user-id="{{$post->user->id}}" post-id="{{ $post->id }}" user-login="{{$post->user->login}}" comment-status='@json($post->allow_comments)'></comment-post>
                </div>
            </div>
        </div>
        <hr>
        <br>
    @endforeach
    <div class="row">
        <div class="col-12">
            {{$followingPosts->links()}}
        </div>
    </div>
</div>
@endsection
