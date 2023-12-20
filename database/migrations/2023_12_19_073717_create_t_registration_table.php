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
        Schema::create('t_registration', function (Blueprint $table) {
            $table->bigIncrements('registration_id')->unsigned();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('extracurricular_id');
            $table->date('registration_date');
            $table->text('approval_letter');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('student_id')->references('student_id')->on('t_student')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('extracurricular_id')->references('extracurricular_id')->on('t_extracurricular')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_registration');
    }
};
