<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrivagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrivages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mat_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('ref');
            $table->text('designation');
            $table->date('date');
            $table->float('qte');
            $table->string('unite', 20);
            $table->string('nv', 20);
            $table->string('nbs', 20);
            $table->string('photo');
            $table->float('rs', 100);
            $table->text('observation');
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
        Schema::dropIfExists('arrivages');
    }
}
