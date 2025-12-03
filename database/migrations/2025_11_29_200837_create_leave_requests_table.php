<?php

use App\Models\LeaveType;
use App\Models\User;
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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'approved_by')
                  ->nullable()
                  ->constrained('users');
            $table->foreignIdFor(LeaveType::class)->constrained();
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('days');
            $table->text('reason');
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
