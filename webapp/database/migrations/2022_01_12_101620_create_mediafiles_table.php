<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediafilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediafiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->unsignedTinyInteger('storage_type')->nullable(); // 0 - local file
            $table->string('uri', 1024);
            $table->char('sha256checksum', 32)->charset('binary')->unique();
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
        Schema::dropIfExists('mediafiles');
    }
}
