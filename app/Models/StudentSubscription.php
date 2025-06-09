<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubscription extends Model
{
     protected $fillable = [
        'std_name',
        'std_email',
        'std_id',
        'password',
        'sub_start_date',
        'sub_end_date',
        'sub_fee',
        'status',
        // 'password',
    ];
}
