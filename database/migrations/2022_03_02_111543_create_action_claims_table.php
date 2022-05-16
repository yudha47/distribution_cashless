<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('action_claim', function (Blueprint $table) {
        $table->id('id_action');
        $table->string('type_action', 100)->nullable();
        $table->string('category', 100)->nullable();
        $table->date('date')->nullable();
        $table->string('member_name', 100)->nullable();
        $table->string('client_id', 100)->nullable();
        $table->datetime('time_distribution')->nullable();
        $table->time('time_receive')->nullable();
        $table->string('remarks_info', 2000)->nullable();
        $table->string('no_claim')->nullable();
        $table->string('pic_id', 100)->nullable();
        $table->string('status', 100)->nullable();
        $table->string('pic_analyst', 100)->nullable();
        $table->datetime('time_process')->nullable();
        $table->datetime('finish_time')->nullable();
        $table->string('action_analyst', 100)->nullable();
        $table->string('remarks_analyst', 2000)->nullable();
        $table->datetime('time_action_analyst')->nullable();
        $table->string('pic_ma', 100)->nullable();
        $table->string('remarks_ma', 2000)->nullable();
        $table->datetime('time_action_ma')->nullable();
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
        Schema::dropIfExists('action_claims');
    }
}
