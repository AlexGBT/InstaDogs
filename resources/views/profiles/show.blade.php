@extends('layouts.app')

@section('content')

     <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{ asset($profile->logo) }}" class="rounded-circle w-100">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4">{{ $profile->user->username }}</div>
{{--                        <follow></follow>--}}

                        @can('view',$profile)
                            <follow user-id="{{ $profile->user_id }}" follows="{{ $follows }}"></follow>
                        @endcan
                        <div class="d-flex">
                            <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                            <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                            <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
                        </div>


                        {{--                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>--}}
                    </div>

                    @can('update', $profile)
                            <a href="{{route('post.create')}}">Add New Post</a>
                    @endcan

                </div>

                @can('update', $profile)
                    <a href="/profile/{{ $profile->id }}/edit">Edit Profile</a>
                @endcan

                <div class="d-flex">
                    {{--                    <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>--}}
                    {{--                    <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>--}}
                    {{--                    <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>--}}
                </div>
                <div class="pt-4 font-weight-bold">{{ $profile->title }}</div>
                <div>{{ $profile->description }}</div>
             </div>
        </div>

        <div class="row pt-5">
            @foreach($profile->posts as $post)
                <div class="col-4 pb-4">
                    <a href="{{route('post.show', ['post' => $post->id ])}}">
                        <img src="/storage/{{ $post->image }}" class="w-100">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
