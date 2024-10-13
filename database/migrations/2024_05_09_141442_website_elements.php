<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WebsiteElements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lastOffersText');
            $table->string('searcherText');
            $table->string('phoneNumberDesktop');
            $table->string('phoneNumberTextMobile');
            $table->string('phoneNumberMobile');
            $table->string('mail');
        });

        Schema::create('aboutUss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aboutUsText');
        });

        Schema::create('buybucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('buybuckText');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
        Schema::dropIfExists('aboutUss');
        Schema::dropIfExists('buybucks');
    }
}
