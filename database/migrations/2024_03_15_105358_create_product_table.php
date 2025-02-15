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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_sku')->unique();
            $table->text('product_description');
            $table->string('product_rating_review')->nullable();
            $table->string('product_image');
            $table->decimal('product_price', 8, 2);
            $table->decimal('product_discounted_price', 8, 2)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('product_slug')->unique();
            $table->string('product_meta_title');
            $table->string('product_meta_keyword');
            $table->string('product_meta_desp');
            $table->enum('product_status', ['active', 'inactive'])->default('active');
            $table->string('product_tag')->nullable();
            $table->boolean('product_feature')->default(false);
            $table->boolean('product_is_selected')->default(false);
            $table->date('product_date');
            $table->text('product_comment')->nullable();
            $table->string('product_color')->nullable();
            $table->integer('product_quantity')->default(0);
            $table->text('product_key_feature')->nullable();
            $table->timestamps();
        
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
