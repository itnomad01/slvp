<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->boolean('record')->default(FALSE);
            $table->boolean('autorecord')->default(FALSE);
            $table->boolean('file_preparation')->default(FALSE);
            $table->boolean('rtmp_status')->default(FALSE);
            $table->ipAddress('rtmp_ip_sender')->nullable();
            $table->boolean('allow_comment')->default(FALSE);
            $table->string('title1', 64);
            $table->string('title2', 64)->nullable();
            $table->string('body', 2048)->nullable();
            $table->uuid('stream_name')->unique();
            $table->string('stream_token', 32);
            $table->dateTime('dt_begin');
            $table->dateTime('dt_end');
            $table->unsignedDecimal('price', 14, 2)->nullable();
            $table->unsignedBigInteger('timeleft')->nullable();
            $table->unsignedBigInteger('timepass')->nullable();
            $table->char('color', 4)->charset('binary')->nullable();
            $table->foreignId('picture_id')->nullable()->constrained('mediafiles')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('videopreview_id')->nullable()->constrained('mediafiles')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('video_id')->nullable()->constrained('mediafiles')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('user_id') //author
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->unsignedBigInteger('cv_before')->default(0);
            $table->unsignedBigInteger('cv_live')->default(0);
            $table->unsignedBigInteger('cv_after')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
