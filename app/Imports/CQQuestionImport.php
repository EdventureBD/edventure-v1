<?php

namespace App\Imports;

use App\Models\Admin\CQ;
use Illuminate\Support\Str;
use App\Models\Admin\Assignment;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Admin\QuestionContentTag;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CQQuestionImport implements ToModel, WithHeadingRow
{
    public $exam;

    public function __construct($exam)
    {
        $this->exam = $exam;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->exam->exam_type === 'CQ') {
            $content_tag_id = $row['content_tag_id'];
            if ($content_tag_id) {
                $content_tag_id = explode(",", $content_tag_id);
            }
            $slug = Str::slug($row['question']);
            $check = CQ::where('slug', $slug)->first();
            if (!$check) {
                $cq = CQ::create([
                    'question' => $row['question'],
                    'slug' => $slug,
                    'image' => $row['image'],
                    'marks' => $row['marks'],
                    'exam_id' => $this->exam->id,
                    'number_of_attempt' => 0,
                    'gain_marks' => 0,
                    'success_rate' => 0,
                    'standard_ans_pdf' => "pdf",
                ]);
                $question_id = CQ::where('slug', $slug)->first();
                if ($content_tag_id) {
                    if (count($content_tag_id) > 0) {
                        for ($i = 0; $i < sizeOf($content_tag_id); $i++) {
                            $question_content_tag = new QuestionContentTag();
                            $question_content_tag->exam_type = 'CQ';
                            $question_content_tag->question_id = $question_id->id;
                            $question_content_tag->content_tag_id = $content_tag_id[$i];
                            $question_content_tag->save();
                        }
                    }
                }
            }
        } else if ($this->exam->exam_type === 'Assignment') {
            $slug = Str::slug($row['question']);
            $check = Assignment::where('slug', $slug)->first();
            if (!$check) {
                return new Assignment([
                    'question' => $row['question'],
                    'slug' => $slug,
                    'image' => $row['image'],
                    'marks' => $row['marks'],
                    'exam_id' => $this->exam->id,
                ]);
            }
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'slug';
    }
}