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
        Schema::create('email_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('user_id')->constrained('users');
            $table->string('new_email')->comment('新規メールアドレス');
            $table->string('token')->comment('認証用トークン');
            $table->timestamp('requested_at')->comment('メールアドレスの更新リクエスト日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_updates');
    }
};
