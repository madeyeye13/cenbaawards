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
    Schema::create('winners', function (Blueprint $table) {
        $table->id();
        $table->foreignId('award_category_id')->nullable()->constrained()->nullOnDelete();
        $table->string('name');
        $table->string('company');
        $table->string('photo')->nullable();
        $table->text('description')->nullable();
        $table->unsignedSmallInteger('year');
        $table->unsignedInteger('order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winners');
    }
};
