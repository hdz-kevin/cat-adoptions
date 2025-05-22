<?php

use App\Models\User;
use App\Models\Cat;
use App\Enums\AdoptionRequestStatus;
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
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users');
            $table->foreignIdFor(Cat::class)->constrained('cats');
            $table->enum('status', AdoptionRequestStatus::values())->default(AdoptionRequestStatus::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_requests');
    }
};
