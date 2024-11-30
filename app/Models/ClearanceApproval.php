<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceApproval extends Model
{
    protected $table = 'clearance_approvals';

    public $timestamps = true;

    protected $fillable = [
        'request_id',
        'clearance_id',
        'employee_type',
        'seqno',
        'clearing_official_user_id',
        'comment',
        'isApproved'
    ]; 
}
