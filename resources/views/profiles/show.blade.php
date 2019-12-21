@extends('layouts.app')

@section('content')
    @include('./layouts/messages')
     <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{ asset($profile->logo) }}" class="rounded-circle w-100">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4">{{ $profile->user->username }}</div>
                        @can('view',$profile)
                            <follow user-id="{{ $profile->user_id }}" follows="{{ $follows }}"></follow>
                        @endcan
                        <div class="d-flex">
                            <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                            <div class="pr-5"><strong>{{ $followersCount }}</strong>
                                <a href="{{route('follow.show.followers',['id' => $profile->user_id])}}">followers</a>
                            </div>
                            <div class="pr-5"><strong>{{ $followingCount }}</strong>
                                <a href="{{route('follow.show.following',['id' => $profile->user_id])}}">following</a>
                            </div>
                        </div>
                     </div>



                    @can('update', $profile)
                        @cannot('view', $profile)
                            <a href="{{route('post.create')}}">Add New Post</a>
                        @endcannot
                    @endcan

                    @cannot('view',$profile)
                        <div>
                            <h3>{{$personInfo}}</h3>
                            <h5>I can:</h5>
                            <ul>
                                @foreach($personPrivileges as $privelege)
                                    <li>{{$privelege}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endcannot


                </div>

                @can('update', $profile)
                    <a href="/profile/{{ $profile->id }}/edit">Edit Profile</a>
                @endcan

                <div class="pt-4 font-weight-bold">{{ $profile->title }}</div>
                <div>{{ $profile->description }}</div>
             </div>
        </div>

         @cannot('view',$profile)
             @if(!$profile->user->email_verified_at)
                 @if (session('resent'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                         {{ __('A fresh verification link has been sent to your email address.') }}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                 @endif
                 <h3>You email is not verified</h3>
                 <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                     @csrf
                     <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Verify Email</button>
                 </form>
             @endif
         @endcannot

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
