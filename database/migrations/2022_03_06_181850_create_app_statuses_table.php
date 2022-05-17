<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_statuses', function (Blueprint $table) {
            $table->id();
            $table->unique(['users_id', 'jobs_id']);
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->foreignId('jobs_id')->constrained()->onDelete('cascade');
            $table->boolean('app_flag')->default(false);
            $table->boolean('favorite')->default(false);
            $table->timestamps();
            $table->index(
                ['users_id', 'jobs_id']
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_statuses');
    }
}
