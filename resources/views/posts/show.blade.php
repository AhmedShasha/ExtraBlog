@extends('layouts.master')

@section('content')
    <div class="row mt-4 ml-4 border-5 border-primary">
        <div class="col-md-9 offset-md-2"></div>
        <div class="card mb-3" style="min-width: 18rem">

            <div class="card-body">
                <div class="card-title">
                    <h4> {{ $posts->title }}</h4>
                </div>
                {{-- <div class="card-text">
                    <img src="{{ asset('storage/images/' . $posts->image) }}" alt="" width="100%" height="250px">
                </div> --}}
                <div class="card-text">
                    {{ $posts->body }}
                </div>
                <hr>

                <small class="text-muted">
                    <p>{{ $posts->created_at }}</p>
                </small>
                <div class="text-muted">
                    <p>Created By : {{ $posts->user->name }}</p>
                </div>

                @auth
                    @if (auth()->user()->id == $posts->user_id)
                        <a href="{{ '/posts/' . $posts->id . '/edit' }}" class="btn btn-primary float-left mr-2">Edit</a>
                        <form action="{{ route('posts.destroy', ['id' => $posts->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger float-left">Delete</button>
                        </form>
                    @endif
                @endauth

            </div>
        </div>
        <div class="card ml-3" style="min-width: 18rem">
            <div class="card-body">
                <div class="card-title">
                    <h5>Comments</h5>
                    <hr>
                    @foreach ($posts->comments as $comment)
                        <div class="display-comment">
                            <strong>{{ $comment->name }}</strong>
                            <p>{{ $comment->comment }}</p>
                        </div>
                        <hr />
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-body ">

            <form method="post" action="{{ route('comment.add') }}">
                @csrf
                <div class="form-group">
                    <label for="comment">Name:</label>
                    <input type="text" class="form-control mb-2" name="name">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control mb-3" rows="4" id="comment" name="comment_body"></textarea>
                    <input type="hidden" name="post_id" value="{{ $posts->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Add Comment" />
                </div>
            </form>
        </div>
    </div>
@endsection
