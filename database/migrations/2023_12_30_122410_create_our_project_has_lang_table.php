<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurProjectHasLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('our_project_has_lang')) {
            return;
        }

        Schema::create('our_project_has_lang', function (Blueprint $table) {
            $table->integer('lang_id');
            $table->foreignId('our_project_id')->constrained('our_projects')->cascadeOnDelete();
            $table->string('our_project_name');
            $table->primary(['lang_id', 'our_project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // The production dump already contains this table; rollback must preserve its data.
    }
}
