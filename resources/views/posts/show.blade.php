@extends('layouts.app')

@section('content')
     <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="w-100">
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
                </div>
            </div>
        </div>
    </div>
@endsection

