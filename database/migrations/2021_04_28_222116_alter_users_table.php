<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->after('password')->nullable();
            $table->unsignedBigInteger('city_id')->after('address')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('subdistrict')->after('city_id')->nullable();
            $table->string('postal_code')->after('subdistrict')->nullable();
            $table->boolean('isAdmin')->default(false)->after('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('city_id');
            $table->dropColumn('subdistrict');
            $table->dropColumn('postal_code');
            $table->dropColumn('isAdmin');
        });
    }
}
