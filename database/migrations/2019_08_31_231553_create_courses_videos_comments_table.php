<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesVideosCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_videos_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_video_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('comment');
            $table->timestamps();
            $table->index('course_video_id');
            $table->index('user_id');
            $table->foreign('course_video_id')->references('id')->on('courses_videos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_videos_comments');
    }
}
