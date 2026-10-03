<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seedlings', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('seo_description')->nullable();
            $table->string('card_title');
            $table->string('card_subtitle')->nullable();
            $table->string('home_title')->nullable();
            $table->string('home_subtitle')->nullable();
            $table->string('price');
            $table->json('tags');
            $table->string('cover_path')->nullable();
            $table->string('cover_alt');
            $table->boolean('show_on_home')->default(false);
            $table->unsignedInteger('home_sort')->default(0);
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_published')->default(false);
            $table->json('blocks');
            $table->timestamps();

            $table->index(['is_published', 'sort']);
            $table->index(['show_on_home', 'home_sort']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seedlings');
    }
};
