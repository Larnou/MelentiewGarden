<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Seedling;
use Illuminate\Database\Seeder;

class ExampleContentSeeder extends Seeder
{
    /**
     * Один саженец и одна статья, чтобы проверить схему на серверной базе.
     */
    public function run(): void
    {
        Seedling::query()->updateOrCreate(
            ['slug' => 'zhebrovskoe'],
            [
                'title' => 'Яблоня · Жебровское',
                'seo_description' => 'Ранне-осенний сорт яблони Жебровское: плоды 35–45 г, медовый вкус, урожайность и зимостойкость.',
                'card_title' => 'ЯБЛОНЯ · Жебровское',
                'card_subtitle' => 'Ранне-осенний сорт',
                'home_title' => 'ЯБЛОНЯ',
                'home_subtitle' => 'Жебровское · ранне-осенний сорт',
                'price' => 'от 800 ₽',
                'tags' => ['seed'],
                'cover_path' => 'seedlings/zhebrovskoe/zh1.jpg',
                'cover_alt' => 'Яблоня сорт Жебровское',
                'show_on_home' => false,
                'home_sort' => 0,
                'sort' => 0,
                'is_published' => true,
                'blocks' => [
                    [
                        'type' => 'heading_text',
                        'title' => 'Характеристики',
                        'paragraphs' => [],
                    ],
                    [
                        'type' => 'list_unordered',
                        'items' => [
                            'Ранне-осенний сорт.',
                            'Плоды массой 35–45 г, жёлтые с ярким румянцем, сладкого, медового вкуса. Мякоть сочная, не крахмалится.',
                            'Созревают в конце августа — начале сентября.',
                            'Дерево среднерослое.',
                            'Сорт зимостойкий, урожайный, плодоносит ежегодно.',
                        ],
                    ],
                    [
                        'type' => 'slider_captions',
                        'slides' => [
                            [
                                'path' => 'seedlings/zhebrovskoe/zh1.jpg',
                                'alt' => '',
                                'caption' => '',
                            ],
                            [
                                'path' => 'seedlings/zhebrovskoe/zh2.jpg',
                                'alt' => '',
                                'caption' => '',
                            ],
                        ],
                    ],
                ],
            ],
        );

        Article::query()->updateOrCreate(
            ['slug' => 'opylenie'],
            [
                'title' => 'Опыление',
                'meta' => 'Два сорта рядом — лучше урожай у яблони, груши и других плодовых',
                'seo_description' => 'Зачем сажать два сорта яблони или груши рядом: перекрёстное опыление, роль ветра и насекомых, урожайность.',
                'tags' => ['apple'],
                'cover_path' => 'articles/opylenie/opilenie.png',
                'cover_alt' => 'Опыление яблони и груши',
                'sort' => 0,
                'is_published' => true,
                'blocks' => [
                    [
                        'type' => 'text',
                        'paragraphs' => [
                            'Для хорошего урожая груши, яблони и других плодовых рекомендуется сажать два разных сорта рядом друг с другом. Большинство сортов не самоплодные или только частично самоплодные, поэтому перекрёстное опыление между разными сортами значительно увеличивает урожайность.',
                            'Растения опыляются ветром и насекомыми. Если рядом нет другого сорта, то опыление может быть недостаточным.',
                        ],
                    ],
                    [
                        'type' => 'slider_captions',
                        'slides' => [
                            [
                                'path' => 'articles/opylenie/opilenie.png',
                                'alt' => 'Как происходит опыление',
                                'caption' => 'Как происходит опыление',
                            ],
                        ],
                    ],
                ],
            ],
        );
    }
}
