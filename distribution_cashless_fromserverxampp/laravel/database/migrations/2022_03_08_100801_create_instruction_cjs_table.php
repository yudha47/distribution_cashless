<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructionCjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruction_cj', function (Blueprint $table) {
            $table->id('id_instruction');
            $table->string('category', 100)->nullable();
            $table->date('date')->nullable();
            $table->string('member_name', 100)->nullable();
            $table->string('client_id', 100)->nullable();
            $table->datetime('time_distribution')->nullable();
            $table->string('remarks_info', 2000)->nullable();
            $table->string('no_claim')->nullable();
            $table->string('pic_id', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('pic_cj', 100)->nullable();
            $table->string('remarks_cj', 2000)->nullable();
            $table->datetime('time_action_cj')->nullable();
            $table->datetime('finish_time')->nullable();
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
        Schema::dropIfExists('instruction_cjs');
    }
}
