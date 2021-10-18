{{--previous student/pages/course/course.blade.php--}}
<x-landing-layout headerBg="white">
    <div class="page-section bg-light-gray">
        <div class="container page__container">
            <div class="page-separator py-4">
                <div class="page-separator__text bg-purple-light text-center bradius-10 py-3 d-inline-block w-100 text-gray text-sm fw-700">Popular Courses</div>
            </div>
            <div class="row card-group-row mb-lg-8pt">
                @foreach ($courses as $course)
                    <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
                        <div class="card mb-3 card-sm card--elevated p-relative js-mdk-reveal card-group-row__card bradius-10 single-course"
                            {{-- data-overlay-onload-show data-popover-onload-show data-force-reveal --}}
                            data-partial-height="44" data-toggle="popover" data-trigger="click">
                            <a href="{{ route('course-preview', $course->slug) }}" class="js-image" data-position="">
                                @if ($course->logo)
                                    <img src="{{ Storage::url($course->logo) }}" style="width: 430px;height: 168px;" alt="course">
                                @else
                                    <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" style="width: 430px;height: 168px;" class="img-fluid img-cover" alt="course">
                                @endif
                                {{-- <span class="overlay__content align-items-start justify-content-start">
                                    <span class="overlay__action card-body d-flex align-items-center">
                                        <i class="material-icons mr-4pt">play_circle_outline</i>
                                        <span class="card-title text-white">Preview</span>
                                    </span>
                                </span> --}}
                            </a>
                            <div class="mdk-reveal__content">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-10"><a class="card-title h2 text-dark" href="{{ route('course-preview', $course->slug) }}">{{ $course->title }}</a></div>
                                        <div class="col-2">
                                            <a href="{{ route('course-preview', $course->slug) }}" data-toggle="tooltip"
                                                data-title="{{ $course->CourseLecture->count() }} Lectures" data-placement="top" data-boundary="window"
                                                class="ml-4pt material-icons text-20 card-course__icon-favorite text-dark"><i class="fas fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="rating flex text-yellow text-xxxsm">
                                            <span class="rating__item"><i class="fas fa-star"></i></span>
                                            <span class="rating__item"><i class="fas fa-star"></i></span>
                                            <span class="rating__item"><i class="fas fa-star"></i></span>
                                            <span class="rating__item"><i class="fas fa-star"></i></span>
                                            <span class="rating__item"><i class="fas fa-star-half"></i></span>
                                        </div>
                                        <small class="text-50">6 hours</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-32pt">
                {{ $courses->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</x-landing-layout>
<?php /*@extends('student.layouts.default', [
                                    'title'=>'Course', 
                                    'pageName'=>'Course', 
                                    'secondPageName'=>'Course'
                                ])

@section('content')
<!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">
        {{-- <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout"> --}}
            {{-- <div class="mdk-drawer-layout__content"> --}}
                <div class="page-section">
                    <div class="container page__container">
                        <div class="page-separator">
                            <div class="page-separator__text">Popular Courses</div>
                        </div>
                        <div class="row card-group-row mb-lg-8pt">
                            @foreach ($courses as $course)
                                <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal card-group-row__card"
                                        {{-- data-overlay-onload-show data-popover-onload-show data-force-reveal --}}
                                        data-partial-height="44" data-toggle="popover" data-trigger="click">
                                        <a href="{{ route('course-preview', $course->slug) }}" class="js-image" data-position="">
                                            @if ($course->logo)
                                                <img src="{{ Storage::url($course->logo) }}" style="widows: 430px;height: 168px;" alt="course">
                                            @else
                                                <img src="{{ asset('student/public/images/paths/mailchimp_430x168.png') }}" alt="course">
                                            @endif
                                            <span class="overlay__content align-items-start justify-content-start">
                                                <span class="overlay__action card-body d-flex align-items-center">
                                                    <i class="material-icons mr-4pt">play_circle_outline</i>
                                                    <span class="card-title text-white">Preview</span>
                                                </span>
                                            </span>
                                        </a>
                                        <div class="mdk-reveal__content">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex">
                                                        <a class="card-title h2" href="{{ route('course-preview', $course->slug) }}">{{ $course->title }}</a>
                                                    </div>
                                                    <a href="{{ route('course-preview', $course->slug) }}" data-toggle="tooltip"
                                                        data-title="{{ $course->CourseLecture->count() }} Lectures" data-placement="top" data-boundary="window"
                                                        class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite</a>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="rating flex">
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star</span></span>
                                                        <span class="rating__item"><span
                                                                class="material-icons">star_border</span></span>
                                                    </div>
                                                    <small class="text-50">6 hours</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-32pt">
                            {{ $courses->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>

            {{-- </div> --}}
        {{-- </div> --}}
    </div>
<!-- // END Header Layout Content -->
@endsection
 */ ?>