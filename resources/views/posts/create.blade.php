@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-9 offset-md-2">
            <h2>Create new post</h2>
            <hr>
            <form action="{{ route('posts') }}" method="POST" class="col-md-9" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" cols="38" rows="4"
                        aria-label="With textarea"></textarea>
                </div>

                {{-- <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Choose Photo</label>
                </div> --}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                </div>

            </form>
        </div>
    </div>

@endsection
