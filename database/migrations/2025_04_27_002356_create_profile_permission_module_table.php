<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateProfilePermissionModuleTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_profile_permission_module', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(Str::uuid());
            $table->uuid('uuid_profile');
            $table->uuid('uuid_permission_module');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uuid_profile')->references('uuid')->on('tbl_profile')->onDelete('cascade');
            $table->foreign('uuid_permission_module')->references('uuid')->on('tbl_permission_module')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_profile_permission_module');
    }
}
