<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedTinyInteger('access_level')->default(0); // 0 - user, 1 - editor, 2 - finmanager, 3 - admin, 4 - root(global admin)
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->string('instagram_id')->nullable();
            $table->string('instagram_token')->nullable();
            $table->string('instagram_refresh_token')->nullable();
            $table->string('yandex_id')->nullable();
            $table->string('yandex_token')->nullable();
            $table->string('yandex_refresh_token')->nullable();
            $table->string('vk_id')->nullable();
            $table->string('vk_token')->nullable();
            $table->string('vk_refresh_token')->nullable();
            $table->foreignId('org_id')
                ->nullable()
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
        Schema::dropIfExists('users');
    }
}
