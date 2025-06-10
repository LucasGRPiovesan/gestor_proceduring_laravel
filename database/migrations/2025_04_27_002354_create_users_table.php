<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(Str::uuid());
            $table->uuid('uuid_profile');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uuid_profile')->references('uuid')->on('tbl_profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tbl_user', function (Blueprint $table) {
        //     $table->dropForeign(['uuid_profile']);
        //     $table->dropColumn('uuid_profile');
        // });
        Schema::dropIfExists('tbl_user');
    }
}
