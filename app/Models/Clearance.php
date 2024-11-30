<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $table = 'clearance';

    public $timestamps = true;
    
    protected $fillable = [
        'description',
        'purpose',
        'statement',
    ]; 
}
