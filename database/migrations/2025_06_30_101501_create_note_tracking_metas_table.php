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
        Schema::create('note_tracking_metas', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('reference_no')->nullable();
            $table->integer('current_status')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('created_ip')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('updated_ip')->nullable();
            $table->timestamps();
        });

        Schema::create('note_tracking_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('note_meta_id')->nullable();
            $table->longText('note_body')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('created_ip')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('updated_ip')->nullable();
            $table->timestamps();
        });

        Schema::create('note_tracking_movements', function (Blueprint $table) {
            $table->id();
            $table->integer('note_meta_id')->nullable();
            $table->longText('note_action')->nullable();
            $table->longText('from_user')->nullable();
            $table->longText('to_user')->nullable();
            $table->longText('message')->nullable();
            $table->Text('status')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('created_ip')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('updated_ip')->nullable();
            $table->timestamps();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_tracking_metas');
        Schema::dropIfExists('note_tracking_contents');
        Schema::dropIfExists('note_tracking_movements');
    }
};
