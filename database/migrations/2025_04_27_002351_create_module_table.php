<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateModuleTable extends Migration
{
    public function up()
    {
        Schema::create('tbl_module', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(Str::uuid());
            $table->uuid('uuid_module')->nullable();
            $table->string('module');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('uuid');
            $table->foreign('uuid_module')->references('uuid')->on('tbl_module');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_module');
    }
}
