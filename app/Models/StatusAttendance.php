<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusAttendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'status_attendances';
    protected $fillable = [
        'name',
    ];
}
