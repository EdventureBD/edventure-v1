<?php

namespace App\Http\Livewire\Course;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Course;
use Livewire\WithFileUploads;
use App\Models\Admin\CourseTopic;
use App\Models\Admin\CourseLecture;
use Illuminate\Support\Facades\Storage;

class AddCourseLecture extends Component
{
    use WithFileUploads;
    public $course;

    public $course_topics;
    public $title;
    public $courseId;
    public $topicId;
    public $url;
    public $markdownText;
    public $pdf;

    public function updatedTitle()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:200'],
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['required', 'string', 'min:3'],
        ]);
    }

    public function updatedCourseId()
    {
        $this->validate([
            'courseId' => 'required',
        ]);
    }

    public function updatedTopicId()
    {
        $this->validate([
            'topicId' => 'required',
        ]);
    }
    public function updatedPdf()
    {
        $this->validate([
            'pdf' => 'mimes:pdf|max:50000',
        ]);
    }

    protected $rules = [
        'title' => ['required', 'string', 'min:1', 'max:200'],
        'url' => ['required', 'string', 'min:3'],
        'courseId' => 'required',
        'topicId' => 'required',
        'markdownText' => 'nullable',
        'pdf' => 'nullable|mimes:pdf|max:50000',

    ];

    public function saveCourseLecture()
    {
        $data = $this->validate();
        $lecture = new CourseLecture;
        $lecture->title = $data['title'];
        $lecture->course_id = $data['courseId'];
        $lecture->topic_id = $data['topicId'];
        $lecture->markdown_text = $data['markdownText'];
        $lecture->url = $data['url'];
        $lecture->slug = Str::slug($data['title']);
        $lecture->status = 1;
        $lecture->order = 0;
        if (!empty($this->pdf)) {
            $lecture->pdf = Storage::url($this->pdf->store('public/lectures/pdf'));
        }

        $save = $lecture->save();

        if ($save) {
            session()->flash('status', 'Course lecture successfully added!');
            return redirect()->route('course.show', $this->course);
        } else {
            session()->flash('failed', 'Course lecture added failed!');
            return redirect()->route('course.add-course-lecture');
        }
    }

    public function mount()
    {
        $this->courseId = $this->course->id;
        $this->course_topics = CourseTopic::where('course_id', $this->course->id)->get();
    }

    public function render()
    {
        return view('livewire.course.add-course-lecture');
    }
}
