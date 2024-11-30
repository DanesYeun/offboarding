<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceRequest extends Model
{
    protected $table = 'clearance_requests';

    protected $fillable = ['user_id', 'employment_type', 'purpose', 'attachment_file_path', 'remarks', 'status']; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type');
    }

    public function clearance_purpose()
    {
        return $this->belongsTo(ClearancePurpose::class, 'purpose');
    }
}
