<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreatePermissionModuleTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_permission_module', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(Str::uuid());
            $table->uuid('uuid_permission');
            $table->uuid('uuid_module');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('uuid_permission')->references('uuid')->on('tbl_permission')->onDelete('cascade');
            $table->foreign('uuid_module')->references('uuid')->on('tbl_module')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_permission_module');
    }
}
