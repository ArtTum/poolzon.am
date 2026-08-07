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
        Schema::create('our_project_has_lang', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Lang::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\OurProject::class)->constrained()->cascadeOnDelete();
            $table->string('name');
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
        Schema::dropIfExists('our_project_has_lang');
    }
}
