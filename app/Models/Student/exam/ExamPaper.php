<?php

namespace App\Models\Student\exam;

use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamPaper extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = "Exam Paper";
    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}