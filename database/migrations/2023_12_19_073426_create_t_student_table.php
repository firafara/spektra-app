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
        Schema::create('t_student', function (Blueprint $table) {
            $table->bigIncrements('student_id')->unsigned();
            $table->foreignId('user_id');
            $table->string('nis',25)->unique();
            $table->foreignId('class_id');
            $table->string('gender',25);
            $table->string('phone_number',25);
            $table->date('birthdate')->nullable();
            $table->string('birthplace',25)->nullable();
            $table->text('address')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('class_id')->references('class_id')->on('t_class')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_student');
    }
};
