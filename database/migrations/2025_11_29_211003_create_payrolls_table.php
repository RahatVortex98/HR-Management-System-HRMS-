<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('month', [
                'jan','feb','mar','apr','may','jun',
                'jul','aug','sep','oct','nov','dec'
            ]);
            $table->integer('year');
            $table->decimal('basic_salary',10,2);
            $table->decimal('allowances',10,2)->default(0);
            $table->decimal('deductions',10,2)->default(0);
            $table->decimal('bonus',10,2)->default(0);
            $table->decimal('net_salary',10,2);
            $table->enum('status',['draft','processed','paid'])
                  ->default('draft')
                  ->comment('draft=calculated, processed=approved, paid=salary paid');;
            $table->date('paid_at')->nullable();

            $table->timestamps();
            $table->unique(['user_id','month','year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
