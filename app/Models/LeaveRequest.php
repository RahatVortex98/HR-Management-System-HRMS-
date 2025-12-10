<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
  protected $fillable = [
    'user_id',
    'leave_type_id',
    'days',
    'reason',
    'approved_by',
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
    public static function getEloquentQuery()
{
    return parent::getEloquentQuery()->with(['user', 'leaveType', 'approver']);
}


}
