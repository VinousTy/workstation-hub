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
        Schema::create('desk_images', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('desk_id')->comment(__('desk_image.desk_id'))->constrained();
            $table->string('file_name', 255)->comment(__('desk_image.file_name'));
            $table->string('extension', 255)->comment(__('desk_image.extension'));
            $table->string('file_path', 255)->comment(__('desk_image.file_path'));
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
        Schema::dropIfExists('desk_images');
    }
};
