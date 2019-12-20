@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row d-flex align-items-center justify-content-md-start">
        <h2>{{$role}} of {{$login}}</h2>
        @foreach ($profiles as $profile)
                <div class="col-12 p-5">
                    <img src="{{ asset($profile->logo) }}" class="img-responsive rounded-circle" style="width: 60px;">
                    <a class="pl-2" href="{{ asset('profile/'.$profile->id)}}">{{ $profile->user->login}}</a>
                 </div>

            @endforeach
        </div>
    </div>

    {{ $profiles->links() }}

@endsection
