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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->enum('metal_type', ['gold', 'silver', 'platinum'])->default('gold');
            $table->decimal('weight', 8, 3)->nullable();

            // Stone Details
            $table->boolean('status')->default(1);
            $table->integer('qty')->default(0);
            $table->string('images')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
