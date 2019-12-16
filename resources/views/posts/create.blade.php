@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="/post" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label">Description</label>
                        <input id="description"
                               type="text"
                               class="form-control"
                               name="description"
                               autocomplete="description" autofocus>
                    </div>

                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                    </div>

                    <div class="row pt-4">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
