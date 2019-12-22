@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row d-flex align-items-center justify-content-md-start">
            <h2>These users liked this post</h2>
            @foreach ($usersThatLikedMe as $user)
                <div class="col-12 p-5">
                    <img src="{{ asset($user->profile->logo) }}" class="img-responsive rounded-circle" style="width: 60px;">
                    <a class="pl-2" href="{{ asset('profile/'.$user->profile->id)}}">{{ $user->login}}</a>
                </div>

            @endforeach
        </div>
    </div>

    {{ $usersThatLikedMe->links() }}

@endsection
