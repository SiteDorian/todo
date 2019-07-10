<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('cascade');
            // $table->index("tag_id");
            // $table->index("task_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_tags');
    }
}
