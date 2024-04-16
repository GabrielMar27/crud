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
        if(Schema::hasTable('posts')) {
            if(!Schema::hasColumn('posts','imageFolder')){
                Schema::table('posts',function (Blueprint $table){
                    $table->string('imageFolder');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_image_folder_column', function (Blueprint $table) {
            //
        });
    }
};
