<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('title_doc', 64)->nullable();
            $table->string('number_doc', 64)->nullable();;
            $table->date('date_doc')->nullable();
            $table->foreignId('ticket_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('sub_accesse_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('user_id') //client
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->decimal('sum', 14, 2)->default(0);
            $table->decimal('total', 14, 2)->default(0);
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
        Schema::dropIfExists('inouts');
    }
}
