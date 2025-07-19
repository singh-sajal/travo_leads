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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->nullable()
                ->references('id')->on('agents')->onDelete('cascade');
            $table->enum('transaction_type', ['added', 'deducted']);
            $table->string('transaction_number')->nullable();
            $table->string('amount')->nullable();
            $table->string('final_balance')->nullable();
            $table->foreignId('query_id')->nullable()
                ->references('id')->on('queries')->onDelete('cascade');
            $table->mediumText('description');
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
        Schema::dropIfExists('transactions');
    }
};
