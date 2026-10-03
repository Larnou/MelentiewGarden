<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Seedling;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'isMain' => true,
            'pageTitle' => 'Сад Мелентьевых',
            'pageDescription' => 'Мы выращиваем только то, что проверили сами: урожайные сорта с вкуснейшими плодами, адаптированные к сибирским морозам',
            'seedlings' => Seedling::query()
                ->published()
                ->where('show_on_home', true)
                ->orderBy('home_sort')
                ->get(),
            'articles' => Article::query()
                ->published()
                ->orderBy('sort')
                ->get(),
        ]);
    }
}
