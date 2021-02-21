<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->string('slug')->required();
            $table->string('code')->required();
            $table->text('description')->nullable(); 
            $table->double('discount_rate')->required(); 
            $table->timestamp('start_date')->required();
            $table->timestamp('end_date')->nullable();
            $table->integer('usage_times')->required();
            $table->timestamp('status')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
