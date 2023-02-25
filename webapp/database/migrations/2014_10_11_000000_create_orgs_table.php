<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orgs', function (Blueprint $table) {
            $table->id();
            $table->string('fulltitle', 512)->nullable();
            $table->string('title', 128);
            $table->string('brandtitle', 128);
            $table->string('ogrn', 15);
            $table->string('inn', 12);
            $table->string('kpp', 9)->nullable();
            $table->string('address', 255);
            $table->string('drawer_status', 2)->nullable();
            $table->string('fintitle', 255);
            $table->string('personal_acc', 20);
            $table->string('bank_name', 128);
            $table->string('bic', 9);
            $table->string('corresp_acc', 20);
            $table->string('kbk', 20)->nullable();
            $table->string('titlekbk', 128)->nullable();
            $table->string('oktmo', 11)->nullable();
            $table->string('purpose', 255)->nullable();
            $table->string('email', 255);
            $table->string('tel', 10);;
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
        Schema::dropIfExists('orgs');
    }
}
