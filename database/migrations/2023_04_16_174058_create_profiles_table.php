<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->comment(__('profile.user_id'))->constrained();
            $table->text('file_path')->comment(__('profile.file_path'))->nullable();
            $table->integer('height')->comment(__('profile.height'))->nullable();
            $table->integer('weight')->comment(__('profile.height'))->nullable();
            $table->string('account', 255)->comment(__('profile.account'))->nullable();
            $table->string('introduction', 1000)->comment(__('profile.introduction'))->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
