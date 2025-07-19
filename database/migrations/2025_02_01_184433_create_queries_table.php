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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('package_id')->nullable()
                ->references('id')->on('packages')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('pickup_location')->nullable();
            // $table->string('destination')->nullable();
            $table->string('no_of_persons')->nullable();
            $table->string('expected_date')->nullable();
            $table->enum('type', ['Facebook', 'Instagram','WhatsApp','Website','Other'])->nullable();
            $table->boolean('status')->default(1);
            $table->string('lead_value')->nullable();
            $table->longText('attribute')->nullable();
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
        Schema::dropIfExists('queries');
    }
};
