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
        Schema::create('tabungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke users
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('target_amount');
            $table->string('category');
            $table->integer('current_amount')->default(0);
            $table->date('deadline')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('low'); // penghasilan atau pengeluaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungans');
    }
};
