@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row d-flex align-items-center justify-content-md-start">
            @foreach ($profiles as $profile)
                <div class="col-12 p-5">
                    <img src="{{ asset($profile->logo) }}" class="img-responsive rounded-circle" style="width: 60px;">
                    <a class="pl-2" href="profile/{{$profile->id}}">{{ $profile->user->name }}</a>
                    <span class="pl-2">Status: <b>{{$profile->title}}</b></span>
                </div>

            @endforeach
        </div>
    </div>

    {{ $profiles->links() }}

@endsection
