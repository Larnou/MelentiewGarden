@extends('layouts.site')

@section('content')
    <section class="article">
        <div class="article__container">
            <a class="article__back" href="{{ route('articles.index') }}">← Назад к статьям</a>
            <h1 class="article__title">{{ $article->title }}</h1>
            @if ($article->meta)
                <p class="article__meta">{{ $article->meta }}</p>
            @endif
            @include('components.blocks', ['blocks' => $article->blocks])
        </div>
    </section>
@endsection