<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('articles.index', [
            'isMain' => false,
            'mainClass' => ' main--article',
            'pageTitle' => 'Статьи сада Мелентьевых',
            'pageDescription' => 'Подборка статей о посадке, уходе и подготовке сада к зиме',
            'articles' => Article::query()->published()->orderBy('sort')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::query()->published()->where('slug', $slug)->firstOrFail();

        return view('articles.show', [
            'isMain' => false,
            'mainClass' => ' main--article',
            'pageTitle' => $article->title,
            'pageDescription' => $article->seo_description ?? '',
            'article' => $article,
        ]);
    }
}
