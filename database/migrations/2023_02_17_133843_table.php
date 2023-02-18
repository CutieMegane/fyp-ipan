<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('tableName');
            $table->integer('columnCount');
            $table->string('tableDesc')->nullable();
            $table->string('col1Name');
            $table->string('col1Type');
            $table->string('col2Name');
            $table->string('col2Type');
            $table->string('col3Name')->nullable();
            $table->string('col3Type')->nullable();
            $table->string('col4Name')->nullable();
            $table->string('col4Type')->nullable();
            $table->string('col5Name')->nullable();
            $table->string('col5Type')->nullable();
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
        Schema::dropIfExists("tables");
    }
}
