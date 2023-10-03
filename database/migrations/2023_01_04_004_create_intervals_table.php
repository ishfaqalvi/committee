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
        Schema::create('intervals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained('committees');
            $table->foreignId('user_id')->constrained('users');
            $table->bigInteger('start_date')->nullable();
            $table->bigInteger('close_date')->nullable();
            $table->integer('order')->default(1);
            $table->integer('payable')->default(0);
            $table->integer('receivable')->default(0);
            $table->enum('status',['Pending','Active','Closed'])->default('Pending');
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
        Schema::dropIfExists('intervals');
    }
};
