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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->text('user_name');
            $table->integer('group_id')->nullable();
            $table->date('date')->nullable();
            $table->string('login_code',50);
            $table->text('login_link')->nullable();
            $table->text('slug')->nullable();
            $table->text('image')->nullable();
            $table->text('name');
            $table->integer('status')->nullable();
            $table->text('title');
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_schema')->nullable();
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
        Schema::dropIfExists('customer');
    }
};
