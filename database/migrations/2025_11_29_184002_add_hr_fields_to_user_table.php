<?php

use App\Models\Department;
use App\Models\Position;
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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Department::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Position::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('employee_id')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('hire_date')->nullable();
            $table->enum('employment_type',['full-time','part-time','contract','intern'])->default('full-time');
            $table->enum('status',['active','inactive','on-leave','terminated'])->default('active');
            $table->decimal('salary',10,2)->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['department_id']);
           

            $table->dropForeign(['position_id']);
           

            $table->dropColumn([
                'employee_id',
                'phone',
                'date_of_birth',
                'hire_date',
                'employment_type',
                'status',
                'salary',
                'address',
                'emergency_contact_name',
                'emergency_contact_phone',
            ]);
        });
    }
};
