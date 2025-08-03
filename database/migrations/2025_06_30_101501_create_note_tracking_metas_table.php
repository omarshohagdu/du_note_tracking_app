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
            $table->integer('current_status')->nullable()->comment('1 = Created, 2 = On Transit, 3= Received, 4= Closed, 5= Temp. Received by Office, 6= Authorized Person Received');
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
            $table->longText('receive_user')->nullable();
            $table->longText('current_status')->nullable()->comment('1=waiting for received, 2=received, 3=another person received');
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
