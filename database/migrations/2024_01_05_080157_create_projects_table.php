<?php

use App\Models\ProjectCategory;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(ProjectCategory::class)->nullable()->constrained()->cascadeOnDelete();

            $table->boolean('visible_on_website')->default(false);
            $table->boolean('visible_in_pdf')->default(false);

            $table->date('started_at');
            $table->date('finished_at')->nullable();

            $table->json('title');
            $table->json('description');
            $table->json('location');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
