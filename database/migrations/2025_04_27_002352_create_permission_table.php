<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreatePermissionTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_permission', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(Str::uuid());
            $table->string('permission');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_permission');
    }
}
