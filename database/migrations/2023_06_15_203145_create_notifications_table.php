<?php

declare(strict_types=1);

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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->comment(__('notification.title'));
            $table->text('body')->comment(__('notification.body'));
            $table->date('published_at')->comment(__('notification.published_at'));
            $table->boolean('is_published')->comment(__('notification.is_published'));
            $table->boolean('is_sent')->default(0)->comment(__('notification.is_sent'));
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
        Schema::dropIfExists('notifications');
    }
};
