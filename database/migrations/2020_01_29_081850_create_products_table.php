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
            $table->bigIncrements('product_id');
            $table->string('product_name')->unique();
            $table->string('product_slug')->unique()->default('');
            $table->string('product_chip');
            $table->integer('product_ram');
            $table->integer('product_storage');
            $table->string('product_battery');
            $table->float('product_screen');
            $table->integer('product_camera_resolution');
            $table->double('product_price');
            $table->longText('product_image')->nullable();
            $table->string('product_color');
            $table->integer('product_weight');
            $table->string('product_feature')->default('Đang cập nhật');
            $table->mediumText('product_describes')->default('');
            $table->tinyInteger('product_sim_slot');
            $table->integer('product_guarantee');
            $table->string('product_operating_system');
            $table->string('product_origin');
            $table->integer('product_year_made');
            $table->string('product_iStock');
            $table->tinyInteger('product_enable');
            $table->integer('product_category_id')->unsigned();
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
