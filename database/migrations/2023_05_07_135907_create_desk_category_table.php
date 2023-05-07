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
        Schema::create('desk_category', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('desk_id')->comment(__('desk_category.desk_id'))->constrained();
            $table->foreignUlid('category_id')->comment(__('desk_category.category_id'))->constrained();
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
        Schema::dropIfExists('desk_category');
    }
};
