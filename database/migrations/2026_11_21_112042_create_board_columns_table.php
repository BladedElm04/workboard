<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('board_columns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('board_id')->constrained('boards')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('color', 7)->default('#94A3B8');
            $table->integer('position')->default(0);
            $table->boolean('is_done')->default(false);
            $table->integer('wip_limit')->nullable();
            $table->index(['board_id', 'position']);
        });

        DB::statement("
            ALTER TABLE board_columns
            ADD CONSTRAINT board_columns_wip_limit_check
            CHECK (wip_limit IS NULL OR wip_limit > 0)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_columns');
    }
};
