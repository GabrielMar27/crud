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
            if(!Schema::hasColumn('posts','wroteBy')){
                if(Schema::hasTable('users')) {
                    if(Schema::hasColumn('users','id')){
                        Schema::table('posts', function (Blueprint $table) {
                            $table->bigInteger('wroteBy');
                        });
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_wrote_by_column', function (Blueprint $table) {
            //
        });
    }
};
