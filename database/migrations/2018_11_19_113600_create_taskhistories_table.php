<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskhistories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned()->index();
            $table->string('crud');
            $table->string('title');
            $table->string('status');
            $table->integer('in_charge_id')->unsigned()->index();
            $table->string('detail');
            $table->timestamp('time_limit')->nullable();
            $table->timestamps();
            
            //$table->foreign('task_id')->references('id')->on('tasks')->onDelete('no action');
            $table->foreign('in_charge_id')->references('id')->on('users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taskhistories');
    }
}
