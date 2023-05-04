<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientVerifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_verify', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('client_id');
            $table->integer('token');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('is_email_verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_verify');
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('is_email_verified');
        });
    }
}
