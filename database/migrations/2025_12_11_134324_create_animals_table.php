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
            $table->string('breed');
            $table->text('description')->nullable();
            $table->string('status');
            $table->string('file')->default(false);
            $table->boolean('vaccine');
            $table->string('specie');
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
