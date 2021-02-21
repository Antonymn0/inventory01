<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by')->index()->required();
            $table->double('new_quantity')->required();
            $table->double('available_quantity')->required();
            $table->string('reason')->required();
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
        Schema::dropIfExists('inventories');
    }
}
