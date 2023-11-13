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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name',35)->nullable()->default('NULL');
            $table->string('email',50)->nullable()->default('NULL');
            $table->string('phone',20)->nullable()->default('NULL');
            $table->text('message')->nullable()->default('NULL');
            $table->string('title',191)->nullable()->default('NULL');
            $table->integer('sorting',11)->default('0');
            $table->enum('status', ['active', 'deactive'])->default('active');
            $table->timestamp('created_at')->nullable()->default('NULL');
		    $table->timestamp('updated_at')->nullable()->default('NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
