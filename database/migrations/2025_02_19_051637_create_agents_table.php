<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password')->nullable();
            $table->string('adhaar_front')->nullable();
            $table->string('adhaar_back')->nullable();
            $table->string('pan')->nullable();
            $table->boolean('phone_verified')->default(0);
            $table->boolean('email_verified')->default(0);
            $table->boolean('kyc')->default(0);
            $table->string('company_name')->nullable();
            $table->string('company_document')->nullable();
            $table->string('company_id')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_pincode')->nullable();
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
        Schema::dropIfExists('agents');
    }
};
