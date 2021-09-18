<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentDetails extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = "Edit Account";
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}