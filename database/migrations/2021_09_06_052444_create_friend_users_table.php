<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('friend_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->enum('status',['pending','confirmed'])->default('pending');
            $table->dateTime('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::table('friend_users', function($table) {
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend_users');
    }
}
