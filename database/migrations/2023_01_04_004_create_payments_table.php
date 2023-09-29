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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interval_id')->constrained('intervals');
            $table->foreignId('user_id')->constrained('users');
            $table->bigInteger('date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('attachment')->nullable();
            $table->string('tags')->nullable();
            $table->enum('approval',['Approved','Not Approved'])->nullable();
            $table->enum('status',['Pending','Submitted'])->default('Pending');
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
        Schema::dropIfExists('payments');
    }
};
