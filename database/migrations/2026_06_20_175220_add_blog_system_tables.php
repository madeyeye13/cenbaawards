<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Extend posts
        Schema::table('posts', function (Blueprint $table) {
            $table->enum('type', ['blog', 'press_release'])->default('blog')->after('id');
            $table->string('og_image')->nullable()->after('meta_description');
            $table->unsignedInteger('order')->default(0)->after('og_image');
        });

        // 2. Tags
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 3. Post <-> Tag pivot
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->unique(['post_id', 'tag_id']);
        });

        // 4. Comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->string('author_name');
            $table->string('author_email');
            $table->text('body');
            $table->enum('status', ['pending', 'approved', 'spam'])->default('pending');
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['type', 'og_image', 'order']);
        });
    }
};