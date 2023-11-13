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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->text('banner_title')->nullable()->default('NULL');
            $table->text('banner_description')->nullable()->default('NULL');
            $table->text('order_now_button')->nullable()->default('NULL');
            $table->string('feature_text',225);
            $table->text('demo_link_title')->nullable()->default('NULL');
            $table->text('demo_link_url')->nullable()->default('NULL');
            $table->text('video_link_url')->nullable()->default('NULL');
            $table->string('testimonial_text',225);
            $table->integer('sorting',11)->nullable()->default('NULL');
            $table->timestamp('created_at')->default('current_timestamp');
            $table->timestamp('updated_at')->default('current_timestamp');
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
        Schema::dropIfExists('landing_pages');
    }
};
