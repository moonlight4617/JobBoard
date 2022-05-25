<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_to_jobs', function (Blueprint $table) {
            $table->id();
            $table->unique(['jobs_id', 'tags_id']);
            $table->foreignId('jobs_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tags_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tag_to_jobs');
    }
}
