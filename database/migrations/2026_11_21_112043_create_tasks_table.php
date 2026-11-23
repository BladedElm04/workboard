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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('column_id')->constrained('board_columns')->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->string('priority', 20)->default('medium');
            $table->integer('position')->default(0);
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('estimate_minutes')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->softDeletes();
            $table->index(['column_id', 'position']);
            $table->index('assigned_to');
            $table->index('created_by');
            $table->index('due_date');
            $table->index('priority');
            $table->index('deleted_at');
        });

        DB::statement("
            ALTER TABLE tasks
            ADD CONSTRAINT tasks_priority_check
            CHECK (priority IN ('low', 'medium', 'high', 'urgent'))
        ");

        DB::statement("
            ALTER TABLE tasks
            ADD CONSTRAINT tasks_estimate_minutes_check
            CHECK (estimate_minutes IS NULL OR estimate_minutes >= 0)
        ");

        DB::statement("
            ALTER TABLE tasks
            ADD CONSTRAINT tasks_due_date_after_start_date
            CHECK (
                start_date IS NULL
                OR due_date IS NULL
                OR due_date >= start_date
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
