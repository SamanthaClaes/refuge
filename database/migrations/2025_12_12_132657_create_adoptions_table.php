<?php

use App\Models\Adopter;
use App\Models\Animal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        if (Schema::hasTable('adoptions')) {
            return;
        }

        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('started_at')->nullable();

            $table->foreignIdFor(Adopter::class)
                ->nullable()
                ->constrained('adopters')
                ->cascadeOnDelete();

            $table->foreignIdFor(Animal::class)
                ->constrained('animals')
                ->cascadeOnDelete();

            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
