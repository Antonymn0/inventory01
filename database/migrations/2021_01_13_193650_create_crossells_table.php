<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrossellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crossells', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('current_product_id')->required();
            $table->bigInteger('crossell_product_id')->required();
            $table->string('name')->required();
            $table->string('slug')->required();
            $table->text('description')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('suspended_at')->nullable();

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
        Schema::dropIfExists('crossells');
    }
}
