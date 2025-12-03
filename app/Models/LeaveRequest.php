<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id',
        'approved_by',
        'leave_type_id',
        'start_time',
        'end_time',
        'days',
        'reason',
        'status',
        'approved_at',
        'rejection_reason',
    ];

    protected $casts = [
        'start_date'=>'date',
        'end_date'=>'date',
        'approved_at'=>'datetime',
    ];
    public function leaveType(){
        return $this->belongsTo(LeaveType::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function approver(){
        return $this->belongsTo(User::class,'approved_by');
    }

}
