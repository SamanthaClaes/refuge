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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('avatar_path')->nullable();
            $table->string('name');
            $table->date('age')->nullable();
            $table->foreignId('breed_id')->constrained()->cascadeOnDelete();
            $table->foreignId('animal_type_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('status');
            $table->boolean('file')->default(false);
            $table->boolean('vaccine');
            $table->boolean('gender');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
