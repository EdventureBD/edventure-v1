<?php

namespace App\Http\Livewire\BatchLecture;

use Livewire\Component;
use App\Models\Admin\Batch;
use App\Models\Admin\BatchLecture;
use App\Models\Admin\Course;
use App\Models\Admin\CourseTopic;

class Create extends Component
{
    public $batch;

    public $title;
    public $batchId;
    public $categoryId;
    public $courseId;
    public $topicId;

    public $batches;
    public $categories;
    public $courses;
    public $topics;

    public $show = true;

    public function updatedBatchId()
    {
        if (!empty($this->batchId)) {
            $batchessssss = Batch::where('id', $this->batchId)->first();
            $this->courses = Course::where('id', $batchessssss->course_id)->first();
            $this->courseId = $this->courses->id;
        }
        $this->validate([
            'batchId' => 'required'
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required'
        ]);
    }

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required'
        ]);
    }

    protected $rules = [
        'batchId' => 'required',
        'courseId' => 'required',
        'topicId' => 'required'
    ];

    public function saveBatchLecture()
    {
        $data = $this->validate();
        $batchLecture = new BatchLecture();
        $batchLecture->batch_id = $data['batchId'];
        $batchLecture->course_id = $data['courseId'];
        $batchLecture->topic_id = $data['topicId'];
        $batchLecture->status = 1;
        $url = url()->previous();
        $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

        $slug = Batch::where('id', $this->batchId)
            ->select('batches.slug')
            ->first();
        $save = $batchLecture->save();

        if ($save) {
            session()->flash('status', 'Batch lecture successfully added!');
            if ($route == "batch.show") {
                return redirect()->route('batch.show', $slug);
            } else {
                return redirect()->route('batch-lecture.index');
            }
        } else {
            session()->flash('failed', 'Batch lecture created failed!');
            return redirect()->route('batch-lecture.create');
        }
    }

    public function mount()
    {
        if (!($this->batch)) {
            $this->batches = Batch::orderBy('title')->get();
            $this->show = false;
        } else {
            $this->batches = Batch::where('id', $this->batch->id)->first();
            $this->batchId = $this->batches->id;
            $this->courses = Course::where('id', $this->batch->course_id)->first();
            $this->courseId = $this->courses->id;
            $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
        }
    }

    public function render()
    {
        if (!empty($this->courseId)) {
            $this->topics = CourseTopic::where('course_id', $this->courseId)->get();
        }
        return view('livewire.batch-lecture.create');
    }
}