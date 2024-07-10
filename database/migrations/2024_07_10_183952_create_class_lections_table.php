<?php
declare(strict_types=1);

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
        Schema::create('class_lections', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('status')->default(\App\Models\ClassLection::STATUS_CREATED);
            $table->foreignId('study_plan_id');
            $table->foreign('study_plan_id')
                ->references('id')
                ->on('study_plans')
                ->onDelete('cascade');
            $table->foreignId('lection_id');
            $table->foreign('lection_id')
                ->references('id')
                ->on('lections')
                ->onDelete('cascade');

//            There should be unique lections in study plan
            $table->unique(['study_plan_id', 'lection_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_lections');
    }
};
