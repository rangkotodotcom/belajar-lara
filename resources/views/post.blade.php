@extends('layout.main')

@section('container')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2>
                {{ $post->title }}
            </h2>

            <p>By :
                <a href="/blog?author={{ $post->author->username }}" class="text-decoration-none">
                    {{ $post->author->name }}
                </a> in
                <a href="/blog?category={{ $post->category->slug }}">
                    {{ $post->category->name }}</a>
            </p>

            @if ($post->image)

            <img src="{{ asset('storage/'. $post->image) }}" class="img-fluid d-block"
                alt="{{ $post->category->name }}">

            @else

            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid d-block"
                alt="{{ $post->category->name }}">

            @endif

            <article class="mb-3 fs-5">

                {!! $post->body !!}

            </article>


            <a href="/blog">Back</a>
        </div>
    </div>
</div>



@endsection