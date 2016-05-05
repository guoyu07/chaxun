<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tid');
            $table->string('dt1');
            $table->string('dt2');
            $table->string('dt3');
            $table->string('dt4');
            $table->string('dt5');
            $table->string('dt6');
            $table->string('dt7');
            $table->string('dt8');
            $table->string('dt9');
            $table->string('dt10');
            $table->string('dt11');
            $table->string('dt12');
            $table->string('dt13');
            $table->string('dt14');
            $table->string('dt15');
            $table->string('dt16');
            $table->string('dt17');
            $table->string('dt18');
            $table->string('dt19');
            $table->string('dt20');
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
        Schema::drop('data');
    }
}
