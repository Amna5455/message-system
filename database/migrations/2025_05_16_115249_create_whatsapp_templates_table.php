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
        Schema::create('whatsapp_templates', function (Blueprint $table) {
            $table->id();
            $table->text('template_name')->nullable();
            $table->integer('language')->nullable();
            $table->text('category')->nullable();
            $table->string('broadcast_type')->nullable();
            $table->text('broadcast_description')->nullable();
            $table->string('broadcast_media')->nullable();
            $table->string('broadcast_media_url')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('body_text')->nullable();
            $table->integer('template_button')->default(0);
            $table->integer('cta_type')->default(0);
            $table->string('phone_number')->nullable();
            $table->text('phone_number_description')->nullable();
            $table->text('website_description')->nullable();
            $table->string('website_url')->nullable();
            $table->integer('website_type')->nullable();
            $table->string('quick_reply_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_templates');
    }
};
