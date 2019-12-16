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
                        <div>
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
                    </div>

                    <hr>

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

