<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_actions', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('action_type', 100)->references('id_type')->on('action_types')->onUpdate('cascade')->onDelete('cascade');
            $table->string('category_name', 100)->nullable();
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
        Schema::dropIfExists('category_actions');
    }
}
