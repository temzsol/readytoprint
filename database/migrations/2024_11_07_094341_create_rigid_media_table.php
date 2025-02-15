<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRigidMediaTable extends Migration
{
    public function up()
    {
        Schema::create('rigid_media', function (Blueprint $table) {
            $table->id();  
            $table->string('media_type');  
            $table->decimal('min_range', 10, 2); 
            $table->decimal('max_range', 10, 2); 
            $table->decimal('price', 10, 2); 
            $table->unsignedBigInteger('product_id');  
            $table->unsignedBigInteger('product_price_id');  
            $table->timestamps();  
            
            // Set up the foreign key relationships (optional, if products and product_prices exist)
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('product_price_id')->references('id')->on('product_price')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rigid_media');
    }
}
