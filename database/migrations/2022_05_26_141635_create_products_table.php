<?php

use App\Enums\ProductStatusEnum;
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
            $table->id();
            $table->timestamps();
            $table->string('product_title', 50);
            $table->longText('product_description')->nullable();
            $table->double('product_base_price', 8, 2)->default(0.0);
            $table->enum('product_status', ProductStatusEnum::toValues())->default(ProductStatusEnum::Available());
            $table->double('product_sold_price', 8, 2)->default(0);
            $table->unsignedBigInteger('product_author');
            $table->unsignedBigInteger('product_buyer')->nullable();
            $table->foreign('product_author')->on('users')->references('id');
            $table->unsignedBigInteger('product_category');
            $table->foreign('product_category')->on('categories')->references('id');
            $table->foreign('product_buyer')->on('users')->references('id');
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
