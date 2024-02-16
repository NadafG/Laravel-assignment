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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('head_family_id');
            $table->string('name');
            $table->date('birthdate');
            $table->enum('marital_status', ['Married', 'Unmarried']);
            $table->date('wedding_date')->nullable(); // Nullable for unmarried individuals
            $table->string('education')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            
            // Define foreign key constraint
            $table->foreign('head_family_id')->references('id')->on('families')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
