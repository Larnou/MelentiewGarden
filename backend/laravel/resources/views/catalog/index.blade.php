@extends('layouts.site')

@section('content')
    <section class="seedlings seedlings--page">
        <div class="seedlings__container">
            <div class="seedlings__header">
                <h1 class="seedlings__title">Каталог саженцев</h1>
            </div>

            <div class="tag-filter js-tag-filter" data-target=".seedlings-card">
                <span class="tag-filter__label">Фильтровать по типам</span>
                <div class="tag-filter__chips">
                    @foreach (config('site.catalog_chips') as $chip)
                        <button class="tag-filter__chip{{ $loop->first ? ' tag-filter__chip--active' : '' }}" type="button" data-tag="{{ $chip['tag'] }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}">{{ $chip['label'] }}</button>
                    @endforeach
                </div>
            </div>

            <div class="seedlings__list seedlings__list--grid">
                @foreach ($seedlings as $seedling)
                    <a class="seedlings-card" href="{{ route('catalog.show', $seedling->slug) }}" data-tags="{{ implode(' ', $seedling->tags ?? []) }}">
                        <img class="seedlings-card__image" src="{{ asset('storage/'.$seedling->cover_path) }}" alt="{{ $seedling->cover_alt }}">
                        <h2 class="seedlings-card__title">{{ $seedling->card_title }}</h2>
                        <p class="seedlings-card__subtitle">{{ $seedling->card_subtitle }}</p>
                        <p class="seedlings-card__price">{{ $seedling->price }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
