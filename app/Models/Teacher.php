<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'teachers';
    protected $fillable = ['user_id', 'subject_id', 'gender_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, "subject_id", "id");
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, "gender_id", "id");
    }
}
