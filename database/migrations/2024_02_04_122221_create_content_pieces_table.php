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
        Schema::create('content_pieces', function (Blueprint $table) {
            $table->id();

            $table
                ->string('identifier')
                ->unique()
                ->index();

            $table->string('type');

            $table->json('text')->nullable();

            $table->smallInteger('image_conversion_width')->nullable();
            $table->smallInteger('image_conversion_height')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_pieces');
    }
};
