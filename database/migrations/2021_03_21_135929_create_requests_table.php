<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project');
            $table->unsignedBigInteger('item');
            $table->integer('quantity');
            $table->string('units');
            $table->unsignedBigInteger('category');
            $table->timestamps();

            $table->foreign('project')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('item')
                ->references('id')
                ->on('itemList')
                ->onDelete('cascade');

            $table->foreign('category')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
