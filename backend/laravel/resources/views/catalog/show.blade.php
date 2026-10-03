@extends('layouts.site')

@section('content')
    <section class="article article--product">
        <div class="article__container">
            <a class="article__back" href="{{ route('catalog.index') }}">← Назад к каталогу</a>
            <h1 class="article__title">{{ $seedling->title }}</h1>
            @include('components.blocks', ['blocks' => $seedling->blocks])
        </div>
    </section>
@endsection
