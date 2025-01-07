<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceCompletedRequirements extends Model
{
    protected $table = 'clearance_completed_requirements';
    protected $fillable = [
        'clearance_request_id',
        'file_name',
        'file_path',
    ];

    public function clearanceRequest()
    {
        return $this->belongsTo(ClearanceRequest::class, 'clearance_request_id');
    }
}
