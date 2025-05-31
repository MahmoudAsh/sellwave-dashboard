<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('product_link')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('price');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}; 