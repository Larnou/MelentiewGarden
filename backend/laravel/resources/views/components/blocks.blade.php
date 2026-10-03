@foreach ($blocks ?? [] as $block)
    @switch($block['type'] ?? '')
        @case('text')
            <div class="article-block article-block--text">
                <div class="article-block__content">
                    @foreach ($block['paragraphs'] ?? [] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
            @break

        @case('heading_text')
            <div class="article-block article-block--heading-text">
                <h2 class="article-block__heading">{{ $block['title'] ?? '' }}</h2>
                @if (! empty($block['paragraphs']))
                    <div class="article-block__content">
                        @foreach ($block['paragraphs'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            @break

        @case('list_ordered')
            <div class="article-block article-block--list article-block--list-ordered">
                <ol class="article-block__list">
                    @foreach ($block['items'] ?? [] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </div>
            @break

        @case('list_unordered')
            <div class="article-block article-block--list article-block--list-unordered">
                <ul class="article-block__list">
                    @foreach ($block['items'] ?? [] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @break

        @case('media_left')
            <div class="article-block article-block--media article-block--media-left">
                <div class="article-block__media-image">
                    <img src="{{ asset('storage/'.$block['path']) }}" alt="{{ $block['alt'] ?? '' }}">
                </div>
                <div class="article-block__media-text">
                    @foreach ($block['paragraphs'] ?? [] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
            @break

        @case('media_right')
            <div class="article-block article-block--media article-block--media-right">
                <div class="article-block__media-text">
                    @foreach ($block['paragraphs'] ?? [] as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
                <div class="article-block__media-image">
                    <img src="{{ asset('storage/'.$block['path']) }}" alt="{{ $block['alt'] ?? '' }}">
                </div>
            </div>
            @break

        @case('slider')
            <div class="article-block article-block--slider">
                <div class="article-block__slider swiper js-article-gallery">
                    <div class="article-block__slider-wrapper swiper-wrapper">
                        @foreach ($block['slides'] ?? [] as $slide)
                            <div class="article-block__slide swiper-slide">
                                <img src="{{ asset('storage/'.$slide['path']) }}" alt="{{ $slide['alt'] ?? '' }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="article-block__slider-controls">
                    <button class="article-block__arrow article-block__arrow--prev" type="button" aria-label="Назад"><span>◀</span></button>
                    <button class="article-block__arrow article-block__arrow--next" type="button" aria-label="Вперёд"><span>▶</span></button>
                </div>
            </div>
            @break

        @case('slider_captions')
            <div class="article-block article-block--slider-captions">
                <div class="article-block__slider swiper js-article-gallery-captions">
                    <div class="article-block__slider-wrapper swiper-wrapper">
                        @foreach ($block['slides'] ?? [] as $slide)
                            <div class="article-block__slide swiper-slide">
                                <img src="{{ asset('storage/'.$slide['path']) }}" alt="{{ $slide['alt'] ?? '' }}">
                                <p class="article-block__slide-caption">{{ $slide['caption'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="article-block__slider-controls">
                    <button class="article-block__arrow article-block__arrow--prev" type="button" aria-label="Назад"><span>◀</span></button>
                    <button class="article-block__arrow article-block__arrow--next" type="button" aria-label="Вперёд"><span>▶</span></button>
                </div>
            </div>
            @break
    @endswitch
@endforeach
