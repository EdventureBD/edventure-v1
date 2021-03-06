<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\CourseCategory;
use App\Http\Controllers\Controller;
use App\Models\Admin\Course;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::orderBy('created_at', 'DESC')->get();
        $total = CourseCategory::count();
        return view('admin.pages.course_category.index', compact('categories', 'total'));
    }

    public function create()
    {
        return view('admin.pages.course_category.create');
    }

    public function show(CourseCategory $courseCategory)
    {
        $courses = Course::where('course_category_id', $courseCategory->id)->get();
        $total = Course::where('course_category_id', $courseCategory->id)->count();
        return view('admin.pages.course_category.details', compact('courseCategory', 'courses', 'total'));
    }

    public function edit(CourseCategory $courseCategory)
    {
        return view('admin.pages.course_category.edit', compact('courseCategory'));
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $delete = $courseCategory->delete();
        if ($delete) {
            return redirect()->route('course-category.index')->with('status', 'Course category successfully deleted!');
        } else {
            return redirect()->route('course-category.index')->with('failed', 'Course category deletion failed!');
        }
    }

    public function changeCourseCategoryStatus(Request $request)
    {
        $obj = CourseCategory::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
