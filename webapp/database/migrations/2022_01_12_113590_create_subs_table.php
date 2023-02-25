<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('title', 64);
            $table->string('body', 2048)->nullable();
            $table->string('img', 1024)->nullable();
            $table->unsignedDecimal('price', 14, 2)->nullable();
            $table->unsignedBigInteger('timeleft');
            $table->foreignId('user_id') //author
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
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
        Schema::dropIfExists('subs');
    }
}
