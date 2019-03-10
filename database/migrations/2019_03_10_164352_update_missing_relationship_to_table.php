<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMissingRelationshipToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });

        Schema::table('hires', function (Blueprint $table) {
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
        });

        Schema::table('options', function (Blueprint $table) {
            $table->foreign('photographer_id')->references('id')->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
        });

        Schema::table('hires', function (Blueprint $table) {
            $table->dropForeign(['coupon_id']);
        });

        Schema::table('options', function (Blueprint $table) {
            $table->dropForeign(['photographer_id']);
        });
    }
}
