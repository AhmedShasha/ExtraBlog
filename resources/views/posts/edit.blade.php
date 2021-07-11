@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-9 offset-md-2">
        <h2>Edit post</h2>
        <hr>
        <form action="{{'/posts/' . $posts->id }}" method="POST" class="col-md-9" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{$posts->title}}">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                {{-- <input type="text" id="body" name="body" class="form-control"> --}}
                <textarea class="form-control" id="body" name="body" cols="38" rows="4" aria-label="With textarea">{{$posts->body}}</textarea>
            </div>
            <div class=" form-group custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label" for="image">Choose Photo</label>
              </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary mt-3">Edit</button>
            </div>

        </form>
    </div>
</div>

@endsection
