<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('details')->nullable();
            $table->UnsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->UnsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('image')->nullable();
            $table->boolean('is_advertise')->default(false);
 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
