<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Seedling extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'title',
        'seo_description',
        'card_title',
        'card_subtitle',
        'home_title',
        'home_subtitle',
        'price',
        'tags',
        'cover_path',
        'cover_alt',
        'show_on_home',
        'home_sort',
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
            'show_on_home' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    protected static function booted(): void
    {
        static::deleting(function (Seedling $seedling): void {
            if ($seedling->slug) {
                Storage::disk('public')->deleteDirectory('seedlings/'.$seedling->slug);
            }
        });
    }
}
