<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc_verifies', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nid');
            $table->string('type');
            $table->string('country');
            $table->integer('status')->default(0)->comment('1==active 0==inactive 2== reject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kyc_verifies');
    }
}
