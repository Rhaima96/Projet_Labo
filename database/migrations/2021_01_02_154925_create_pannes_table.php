<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePannesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pannes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mat_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('m_panne', 100);
            $table->float('qte');
            $table->string('unite', 100);
            $table->string('resp', 100);
            $table->date('date');
            $table->timestamps();

            $table->foreign('mat_id')->references('id')->on('materiels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pannes');
    }
}
