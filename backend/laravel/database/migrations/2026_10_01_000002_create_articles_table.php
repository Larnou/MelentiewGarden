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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('meta')->nullable();
            $table->text('seo_description')->nullable();
            $table->json('tags');
            $table->string('cover_path')->nullable();
            $table->string('cover_alt');
            $table->unsignedInteger('sort')->default(0);
            $table->boolean('is_published')->default(false);
            $table->json('blocks');
            $table->timestamps();

            $table->index(['is_published', 'sort']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
