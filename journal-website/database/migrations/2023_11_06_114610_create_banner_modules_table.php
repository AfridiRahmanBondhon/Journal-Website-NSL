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
        Schema::create('banner_modules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id',20)->unsigned();
            $table->string('banner_heading',225);
            $table->string('banner_text',225);
            $table->text('banner_img1');
            $table->text('banner_img2');
            $table->text('banner_img3');
            $table->text('banner_url');
            $table->timestamp('created_at')->default('current_timestamp');
            $table->timestamp('updated_at')->default('current_timestamp');
            $table->integer('sorting')->nullable();
            $table->enum('status', ['active', 'deactive'])->default('active');
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
        Schema::dropIfExists('banner_modules');
    }
};
