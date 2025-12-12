<?php

use App\Models\Adopter;
use App\Models\Animal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('started_at')->nullable();
            $table->foreignIdFor(Adopter::class)->constrained('adopters');
            $table->foreignIdFor(Animal::class)->constrained('animals');
            $table->timestamp('closed_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
