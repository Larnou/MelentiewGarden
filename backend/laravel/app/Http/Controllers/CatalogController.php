<?php

namespace App\Http\Controllers;

use App\Models\Seedling;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        return view('catalog.index', [
            'isMain' => false,
            'mainClass' => ' main--article',
            'pageTitle' => 'Каталог саженцев',
            'pageDescription' => 'Полный список саженцев сада Мелентьевых',
            'seedlings' => Seedling::query()->published()->orderBy('sort')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $seedling = Seedling::query()->published()->where('slug', $slug)->firstOrFail();

        return view('catalog.show', [
            'isMain' => false,
            'mainClass' => ' main--article',
            'pageTitle' => $seedling->title,
            'pageDescription' => $seedling->seo_description ?? '',
            'seedling' => $seedling,
        ]);
    }
}
