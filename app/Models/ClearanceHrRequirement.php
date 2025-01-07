<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceHrRequirement extends Model
{

    protected $table = 'clearance_hr_requirements';
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
