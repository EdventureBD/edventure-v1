<?php

namespace App\Http\Livewire\LiveClass;

use Livewire\Component;
use App\Models\Admin\Batch;
use Illuminate\Support\Str;
use App\Models\Admin\LiveClass;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseCategory;

class Create extends Component
{
    public $title;
    public $batchId;
    public $categoryId;
    // public $course_id;
    public $topicId;
    public $liveLink;
    public $startTime;
    public $startDate;
    public $isSpecial;

    public $batches;
    public $categories;
    public $courses;
    public $topics = [];

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|string|max:200'
        ]);
    }

    public function updatedBatchId()
    {
        //$courseId = Batch::select('course_id')->where('id', $this->batchId)->first();
        //$this->course_id = $courseId->course_id;
        $this->validate([
            'batchId' => 'required'
        ]);
    }

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required'
        ]);
    }

    public function updatedliveLink()
    {
        $this->validate([
            'liveLink' => 'required|url'
        ]);
    }

    public function updatedStartTime()
    {
        $this->validate([
            'startTime' => 'required|date_format:H:i|'
        ]);
    }

    public function updatedStartdate()
    {
        $this->validate([
            'startDate' => 'required|date|'
        ]);
    }

    public function updatedisSpecial()
    {
        if ($this->isSpecial == true) {
            $this->topicId = null;
        }
    }

    protected $rules = [
        'title' => 'required|string|max:200',
        'batchId' => 'required',
        'topicId' => 'nullable',
        'liveLink' => 'required|url',
        'startTime' => 'required|date_format:H:i|',
        'startDate' => 'required|date|',
        'isSpecial' => 'nullable',
        // 'course_id' => 'required'
    ];

    public function saveLiveClass()
    {
        $data = $this->validate();
        $live_class = new LiveClass();
        $live_class->title = $data['title'];
        $live_class->slug = Str::slug($data['title']);

        $live_class->batch_id = $data['batchId'][0];
        $live_class->topic_id = $data['topicId'];
        $live_class->start_time = $data['startTime'];
        $live_class->start_date = $data['startDate'];
        $live_class->live_link = $data['liveLink'];
        $live_class->is_special = $data['isSpecial'];
        // $live_class->course_id = $data['course_id'];
        $live_class->order = 0;
        $live_class->status = 1;

        $save = $live_class->save();

        if ($save) {
            session()->flash('status', 'Live class successfully added!');
            return redirect()->route('live-class.index');
        } else {
            session()->flash('failed', 'Live class added failed!');
            return redirect()->route('live-class.create');
        }
    }

    public function mount()
    {
        $this->batches = Batch::orderBy('title')->where('status', 1)->get();
        // $this->categories = CourseCategory::orderBy('title')->get();
    }

    public function render()
    {
        if (!empty($this->batchId)) {
            $batch_data = Batch::select('course_id')->where('id', $this->batchId)->first();
            $this->topics = CourseTopic::where('course_id', $batch_data->course_id)->get();
        }
        return view('livewire.live-class.create');
    }
}
