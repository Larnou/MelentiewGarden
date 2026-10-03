<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'title',
        'meta',
        'seo_description',
        'tags',
        'cover_path',
        'cover_alt',
        'sort',
        'is_published',
        'blocks',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'json:unicode',
            'blocks' => 'json:unicode',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    protected static function booted(): void
    {
        static::deleting(function (Article $article): void {
            if ($article->slug) {
                Storage::disk('public')->deleteDirectory('articles/'.$article->slug);
            }
        });
    }
}
