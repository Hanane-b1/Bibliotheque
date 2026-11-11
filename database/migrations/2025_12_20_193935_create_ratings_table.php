<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('livre_id')->constrained('livres')->onDelete('cascade');
            $table->integer('rating'); // 1-5 stars
            $table->timestamps();

            // A user can only rate a book once
            $table->unique(['user_id', 'livre_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};