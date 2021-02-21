<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('approved_by')->index()->required();
            $table->string('title')->required();
            $table->string('slug')->required();
            $table->text('description')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
