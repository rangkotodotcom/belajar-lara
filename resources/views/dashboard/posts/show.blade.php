@extends('dashboard.layout.main')

@section('container')

<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h2>
                {{ $post->title }}
            </h2>

            <a href="/dashboard/posts" class="btn btn-success">Back</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning">Edit</a>

            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">

                @method('DELETE')
                @csrf

                <button type="submit" class="btn btn-danger" style="border: 0" onclick="return confirm('Sure?')">
                    Delete
                </button>

            </form>

            @if ($post->image)

            <img src="{{ asset('storage/'. $post->image) }}" class="img-fluid mt-3 d-block"
                alt="{{ $post->category->name }}">

            @else

            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid d-block mt-3"
                alt="{{ $post->category->name }}">

            @endif

            <article class="mb-3 fs-5">

                {!! $post->body !!}

            </article>


            <a href="/dashboard/posts">Back</a>
        </div>
    </div>
</div>

@endsection