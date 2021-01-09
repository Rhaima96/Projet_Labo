<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mat_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('date');
            $table->float('qte');
            $table->string('unite', 100);
            $table->float('rs', 100);
            $table->string('nbs', 100);
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
        Schema::dropIfExists('stocks');
    }
}
