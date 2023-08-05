<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trafficData', function (Blueprint $table){
            $table->id();
            $table->dateTime('time');
            $table->boolean('weekend');
            $table->string('collisionType')->nullable();
            $table->string('injuryType')->nullable();
            $table->string('primaryFactor')->nullable();
            $table->string('reportedLocation')->nullable();
            $table->float('lat')->nullable();
            $table->float('long')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trafficData');
    }
};
