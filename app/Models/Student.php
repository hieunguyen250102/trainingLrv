<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'phone',
        'birthday',
        'address',
        'gender',
        'status',
        'faculty_id',
        'code',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'student_subject', 'student_id', 'subject_id')->withPivot('mark');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
