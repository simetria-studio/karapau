<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToBuyerInduvidualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_induviduals', function (Blueprint $table) {
            $table->string('codigo_postal')->nullable();
            $table->string('regiao')->nullable();
            $table->string('porta')->nullable();
            $table->string('distrito')->nullable();
            $table->string('conselho')->nullable();
            $table->string('freguesia')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer_induviduals', function (Blueprint $table) {
            //
        });
    }
}
