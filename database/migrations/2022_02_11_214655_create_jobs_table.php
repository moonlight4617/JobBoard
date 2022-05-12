<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companies_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('job_name');
            $table->text('detail');
            $table->string('catch');
            $table->integer('emp_status');
            $table->string('conditions')->nullable();
            $table->string('duty_hours')->nullable();
            $table->integer('low_salary')->nullable();
            $table->integer('high_salary')->nullable();
            $table->string('holiday')->nullable();
            $table->string('benefits')->nullable();
            $table->integer('rec_status')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
