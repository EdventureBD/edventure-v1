<?php

namespace App\Models\Student\exam;

use App\Models\User;
use App\Models\Admin\CQ;
use App\Models\Admin\MCQ;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\Assignment;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailsResult extends Model
{
    use HasFactory, LogsActivity;
    protected static $logName = "Details Result";
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(MCQ::class);
    }

    public function cqQuestion()
    {
        return $this->belongsTo(CQ::class, 'question_id', 'id');
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'question_id', 'id');
    }
}