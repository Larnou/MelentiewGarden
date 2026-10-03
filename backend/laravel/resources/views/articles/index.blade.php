@extends('layouts.site')

@section('content')
    <section class="articles articles--page">
        <div class="articles__container">
            <div class="articles__header">
                <h1 class="articles__title">Все статьи</h1>
                <p class="articles__subtitle">Собрали материалы о посадке, уходе и подготовке сада к нашим сибирским условиям.</p>
            </div>

            <div class="tag-filter js-tag-filter" data-target=".article-card">
                <span class="tag-filter__label">Фильтровать по темам</span>
                <div class="tag-filter__chips">
                    @foreach (config('site.article_chips') as $chip)
                        <button class="tag-filter__chip{{ $loop->first ? ' tag-filter__chip--active' : '' }}" type="button" data-tag="{{ $chip['tag'] }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}">{{ $chip['label'] }}</button>
                    @endforeach
                </div>
            </div>

            <div class="articles__list articles__list--grid">
                @foreach ($articles as $article)
                    <a class="article-card" href="{{ route('articles.show', $article->slug) }}" data-tags="{{ implode(' ', $article->tags ?? []) }}">
                        <img class="article-card__image" src="{{ asset('storage/'.$article->cover_path) }}" alt="{{ $article->cover_alt }}">
                        <h2 class="article-card__title">{{ $article->title }}</h2>
                        <p class="article-card__meta">{{ $article->meta }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
