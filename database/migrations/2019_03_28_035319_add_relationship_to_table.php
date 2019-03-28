<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission_role', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        Schema::table('invoice_option', function (Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('profiles', function (Blueprint $table) {
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
        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign(['role_id', 'permission_id']);
        });

        Schema::table('invoice_option', function (Blueprint $table) {
            $table->dropForeign(['invoice_id', 'option_id']);
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['album_id', 'user_id']);
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'photographer_id']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id', 'receiver_id']);
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
