<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceApproval extends Model
{
    protected $table = 'clearance_approvals';

    public $timestamps = true;

    protected $fillable = [
        'request_id',
        'seqno',
        'clearing_official_user_id',
        'comment',
        'isApproved'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class, 'clearing_official_user_id', 'id');
    }
}
