<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory,HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'position_id',
        'employee_id',
        'phone',
        'date_of_birth',
        'hire_date',
        'emplopyment_type',
        'status',
        'salary',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function position(){
        return $this->belongsTo(Position::class);
    }
    public function attendences(){
        return $this->hasMany(Attendence::class);
    }
    public function leave_requests(){
        return $this->hasMany(LeaveRequest::class);
    }
    public function payrolls(){
        return $this->hasMany(Payroll::class);
    }
    public function performance_reviews(){
        return $this->hasMany(PerformanceReview::class);
    }

    // Auto-generate employee ID
    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->employee_id) {
                $user->employee_id = 'EMP-' . str_pad((User::max('id') ?? 0) + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }

}
