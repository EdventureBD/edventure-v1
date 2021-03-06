<?php

namespace App\Models\Student\exam;

use App\Models\User;
use App\Models\Admin\Exam;
use App\Models\Admin\Batch;
use App\Models\Admin\ContentTag;
use App\Models\Admin\CQ;
use App\Models\Admin\QuestionContentTag;
use App\Models\AppModel;
use App\Utils\Edvanture;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionContentTagAnalysis extends AppModel
{
    use HasFactory;
    protected $fillable = ['content_tag_id', 'student_id', 'exam_type', 'question_id', 'number_of_attempt', 'gain_marks', 'status'];
    protected static $logName = "Question content tag analysis";

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

    public function contentTag()
    {
        return $this->belongsTo(ContentTag::class, 'content_tag_id');
    }

    public function cqQuestion()
    {
        return $this->belongsTo(CQ::class, 'question_id');
    }

    public function saveQuesConTagAnalysis($input)
    {
        if (empty($input['question_id'])) return;
        $tags = (new QuestionContentTag())->where('exam_type', $input['exam_type'])->where('question_id', $input['question_id'])->get();
        if ($tags->count()) {
            foreach ($tags as $tag) {
                $tagAnalaysis = new QuestionContentTagAnalysis();
                $input['content_tag_id'] = $tag->content_tag_id;
                $input['number_of_attempt'] = 1;
                $tagAnalaysis->saveData($input);
            }
        }
    }

    public function getTagAnalysisReport($student_id, $batch_id = null, $course_id = null)
    {
        if (empty($course_id)) {
            $batch = (new Batch())->getById($batch_id);
            $course_id = $batch->course_id;
        }
        $analysis = $this->with('contentTag')->with('cqQuestion')->where('student_id', $student_id)->get();

        $gain_marks = [];
        $total_marks = [];
        $mcq_tag_details = [];
        $cq_tag_details = [];
        foreach ($analysis as $analyst) {
            if ($analyst->contentTag->course_id == $course_id) {
                $contentTag = trim($analyst->contentTag->title);
                if ($analyst->exam_type == Edvanture::MCQ) {
                    if (!isset($gain_marks[$contentTag])) $gain_marks[$contentTag] = [];
                    if (!isset($total_marks[$contentTag])) $total_marks[$contentTag] = [];
                    if (!isset($gain_marks[$contentTag][Edvanture::MCQ])) $gain_marks[$contentTag][Edvanture::MCQ] = 0;
                    if (!isset($total_marks[$contentTag][Edvanture::MCQ])) $total_marks[$contentTag][Edvanture::MCQ] = 0;
                    $gain_marks[$contentTag][Edvanture::MCQ] += $analyst->gain_marks;
                    $total_marks[$contentTag][Edvanture::MCQ] += 1;

                    if (!isset($mcq_tag_details[$contentTag])) $mcq_tag_details[$contentTag] = [];
                    $mcq_tag_details[$contentTag]['topic_id'] = $analyst->contentTag->topic_id;
                } else if (($analyst->exam_type == Edvanture::CQ)) {
                    if (!isset($gain_marks[$contentTag])) $gain_marks[$contentTag] = [];
                    if (!isset($total_marks[$contentTag])) $total_marks[$contentTag] = [];
                    if (!isset($gain_marks[$contentTag][Edvanture::CQ])) $gain_marks[$contentTag][Edvanture::CQ] = 0;
                    if (!isset($total_marks[$contentTag][Edvanture::CQ])) $total_marks[$contentTag][Edvanture::CQ] = 0;
                    $gain_marks[$contentTag][Edvanture::CQ] += $analyst->gain_marks;
                    $total_marks[$contentTag][Edvanture::CQ] += !empty($analyst->cqQuestion->marks) ? $analyst->cqQuestion->marks : 0;

                    if (!isset($cq_tag_details[$contentTag])) $cq_tag_details[$contentTag] = [];
                    $cq_tag_details[$contentTag]['topic_id'] = $analyst->contentTag->topic_id;
                }
            }
        }

        $mcq_strength = [];
        $cq_strength = [];
        $mcq_weakness = [];
        $cq_weakness = [];

        foreach ($gain_marks as $tag => $value) {
            $tag = trim($tag);
            if (!empty($value[Edvanture::MCQ])) {
                $mcq = round(($value[Edvanture::MCQ] * 100) / $total_marks[$tag][Edvanture::MCQ]);
                $mcq_tag_details[$tag]['score'] = $mcq;
                if ($mcq >= 80) array_push($mcq_strength, $tag);
                else if ($mcq <= 50) array_push($mcq_weakness, $tag);
            }
            if (!empty($value[Edvanture::CQ]) && $total_marks[$tag][Edvanture::CQ] > 0) {
                $cq = round(($value[Edvanture::CQ] * 100) / $total_marks[$tag][Edvanture::CQ]);
                $cq_tag_details[$tag]['score'] = $cq;
                if ($cq >= 80) array_push($cq_strength, $tag);
                else if ($cq <= 50) array_push($cq_weakness, $tag);
            }
        }
        return [
            'mcq' => ['weakness' => $mcq_weakness, 'strength' => $mcq_strength],
            'cq' => ['weakness' => $cq_weakness, 'strength' => $cq_strength],
            'mcq_tag_details' => $mcq_tag_details,
            'cq_tag_details' => $cq_tag_details,
        ];
    }
}
