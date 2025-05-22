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
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adopter_id')->nullable()->constrained('users');
            $table->boolean('is_adopted')->default(false);
            $table->string('name');
            $table->string('breed');
            $table->tinyInteger('age', unsigned: true);
            $table->string('photo');
            $table->boolean('vaccinated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
