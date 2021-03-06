{{--previous student/pages/batch/batch_lecture.blade.php--}}

<x-landing-layout headerBg="white">
    <div class="page-section course-info bg-gradient-purple py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="text-white fw-800">Batch: {{ $batch->title }}</h2>
                    <p class="text-white">{{ $course->description }}</p>
                </div>
                <div class="col-md-5">
                    
                    <p class="text-xsm text-white font-weight-light m-0">
                        Your batch days running : {{ $batch->batch_running_days }} days <br>
                        You have bought : {{ $accessedDays->accessed_days }} days <br>
                        Days remaining :
                        @php
                            echo $accessedDays->accessed_days - $batch->batch_running_days . ' days';
                        @endphp
                    </p>
                </div>
            </div>
        </div>

    </div>
    
    <div class=" border-bottom-2 py-5">
        <div class="container page__container max-w-50 w-100">
            @if(session()->has('payment_success'))
                <div class="alert alert-info text-center ">
                    <p class="mb-0 text-xxsm">{{session()->get('payment_success')}}</p>
                </div>
            @endif
            @if (count($specialExams) > 0)
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                            <div class="accordion__item">
                                <div class="bg-purple-light text-center bradius-10">
                                    <a href="#" class="accordion__toggle py-3 d-inline-block w-100" data-toggle="collapse"
                                        data-target="#specialExams1" data-parent="#parent">
                                        <span class="text-gray text-sm fw-700">Mock Test</span>
                                        <span class="d-inline-block float-right text-gray text-sm">
                                            <span class="arrow-up text-gray"><i class="fas fa-angle-up"></i></span>
                                        <span class="arrow-down text-gray"><i class="fas fa-angle-down"></i></span></span>
                                    </a>
                                </div>
                                <div class="accordion__menu collapse show" id="specialExams1">
                                    
                                    @forelse ($specialExams as $specialExam)
                                        @php
                                           $sp_view_result = "View Result";
                                            // if ($specialExam->canAttemp ) {
                                            //     $sp_view_result = "Start Exam";
                                            // }
                                            if ($specialExam->canAttemp && $specialExam->exam->exam_type == 'Assignment') {
                                                    $sp_view_result = "Submit Assignment";
                                                } else if ($specialExam->canAttemp){
                                                    $sp_view_result = "Start Exam";
                                                }
                                        @endphp
                                        <div class="accordion__menu-link bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a class="text-dark fw-600" href="#">{{ $specialExam->exam->title }}</a>
                                                <div class="text-dark">
                                                    <span class="d-inline-block bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">{{ $specialExam->exam->exam_type }}</span>
                                                    <a href="{{ route('question', [$batch->slug, $specialExam->exam->slug]) }}" class="d-inline-block text-dark ml-4 bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">{{$sp_view_result}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        No Topics found
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="page-separator mt-5">
                <div class="page-separator__text bg-purple-light text-center bradius-10 py-3 d-inline-block w-100 text-gray text-sm"><span class="fw-700">Solution Of The Exams</span>
                    <p class="text-gray text-xxsm fw-200 lh-1">Solution videos and PDFs will appear here after everyone has completed all the exams</p></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                        @forelse ($batchTopics as $batchTopic)
                            <div class="accordion__item {{ $loop->iteration == 1 ? 'open' : '' }}  ">
                                <div class="row no-gutters accordion__toggle bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600" data-toggle="collapse" data-target="#course-toc-{{ $batchTopic->id }} " data-parent="#parent">
                                    <div class="col-11 d-inline-flex title align-items-center">
                                        <span class="">{{ $batchTopic->courseTopic->title }} </span>
                                    </div>
                                    <div class="col-1 text-right">
                                        <span class="d-inline-block text-gray text-sm">
                                            <span class="arrow-up text-gray"><i class="fas fa-angle-up"></i></span>
                                            <span class="arrow-down text-gray"><i class="fas fa-angle-down"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="accordion__menu collapse {{ $loop->iteration == 1 ? 'show' : '' }} "
                                    id="course-toc-{{ $batchTopic->id }}">
                                    {{-- @livewire('student.batch.lectures', ['batchTopic' => $batchTopic->id, 'batch' =>
                                    $batch], key($batchTopic->id)) --}}
                                    <div>
                                        @forelse($batchTopic->courseTopic->CourseLecture as $courseLecture)
                                            <div class="accordion__menu-link d-flex justify-content-between align-items-center bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600">
                                                <a class="flex text-dark fw-600" href="">
                                                    {{ $courseLecture->title }}
                                                </a>
                                                <a href="{{ route('topic_lecture', [$batch->slug, $courseLecture->slug]) }}" class="d-inline-block text-dark ml-4 bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">View Lecture</a>
                                            </div>
                                        @empty
                                            <div class="accordion__menu-link">
                                                <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                    <i class="fad fa-empty-set"></i>
                                                </span>
                                                <a class="flex" href="#">No lectures found </a>
                                            </div>
                                        @endforelse
                                        <p class="h6 pt-3" style="text-align: center;">Exams or Assignment</p>
                                        @forelse($exams as $exam)
                                            @php
                                            $view_result = "View Result";
                                                if ($exam->canAttemp && $exam->exam->exam_type == 'Assignment') {
                                                    $view_result = "Submit Assignment";
                                                } else if ($exam->canAttemp){
                                                    $view_result = "Start Exam";
                                                }
                                            @endphp
                                            @if ($exam->exam->topic_id == $batchTopic->topic_id)
                                            <div class="accordion__menu-link d-flex justify-content-between align-items-center bg-light-gray mt-3 py-2 px-3 bradius-15 bshadow text-dark fw-600">
                                                 <a class="flex text-dark" href="#">
                                                    {{ $exam->exam->title }}
                                                </a>
                                                <div>
                                                    <span class="text-dark bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">{{ $exam->exam->exam_type }}</span>
                                                    <a href="{{ route('question', [$batch->slug, $exam->exam->slug]) }}" class="d-inline-block text-dark ml-4 bg-light-gray bradius-15 bshadow px-2 fw-600 py-1">{{$view_result}}</a>
                                                </div>
                                            </div>
                                            @endif
                                        @empty
                                            <div class="accordion__menu-link">
                                                <span class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                    <i class="fad fa-empty-set"></i>
                                                </span>
                                                <a class="flex" href="#">No exams found </a>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @empty
                            No Topics found
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php /* 
@extends('student.layouts.default', [
'title'=>'Batch Lecture',
'pageName'=>'Batch Lecture',
'secondPageName'=>'Batch Lecture'
])
@section('content') 
    
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content page-content ">

        <div class="mdk-box bg-primary js-mdk-box mb-0" data-effects="blend-background">
            <div class="mdk-box__content">
                <div class="hero py-64pt text-center text-sm-left">
                    <div class="container page__container">
                        {{-- <h2 class="text-white">Batch: {{ $batch->title }}</h2>
                        <p class="lead text-white-50 measure-hero-lead"> {{ $course->description }} </p> --}}
                        <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
                            <h1 class="text-white flex m-0">Batch: {{ $batch->title }}</h1>
                            <p class="h3 text-white-50 font-weight-light m-0">
                                Your batch days running : {{ $accessedDays->individual_batch_days }} days <br>
                                You have bought : {{ $accessedDays->accessed_days }} days <br>
                                Days remaining :
                                @php
                                    echo $accessedDays->accessed_days - $accessedDays->individual_batch_days . ' days';
                                @endphp
                            </p> <br>
                            {{-- <p class="h1 text-white-50 font-weight-light m-0"> <span id="countdownMinuits-xs"></span> : <span id="countdownSecound-xs"></span></p> --}}
                        </div>
                        <p class="hero__lead measure-hero-lead text-white-50">
                            {{ $course->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-section border-bottom-2">
            <div class="container page__container w-50">
                @if (count($specialExams) > 0)
                    {{-- @if ($specialExams->exam->special == 1) --}}
                    {{-- <div class="page-separator">
                        <div class="page-separator__text">Table of Contents</div>
                    </div> --}}
                    <div class="row mb-3">
                        <div class="col-lg-12">

                            <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                                <div class="accordion__item">
                                    <a href="#" class="accordion__toggle collapsed h3" data-toggle="collapse"
                                        data-target="#specialExams1" data-parent="#parent">
                                        <span class="flex">Special Exam</span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <div class="accordion__menu collapse show"
                                        id="specialExams1">
                                        @forelse ($specialExams as $specialExam)
                                            <div class="accordion__menu-link">
                                                <span
                                                    class="icon-holder icon-holder--small icon-holder--dark rounded-circle d-inline-flex icon--left">
                                                    <i class="fad fa-pen"></i>
                                                </span>
                                                <a class="flex"
                                                    href="{{ route('question', [$batch->slug, $specialExam->exam->slug]) }}">
                                                    {{ $specialExam->exam->title }}
                                                    <span
                                                        class="float-right text-primary">{{ $specialExam->exam->exam_type }}</span>
                                                </a>
                                            </div>
                                        @empty
                                            No Topics found
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endif

                <div class="page-separator mt-5">
                    <div class="page-separator__text">Table of Contents</div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">
                            @forelse ($batchTopics as $batchTopic)
                                <div class="accordion__item {{ $loop->iteration == 1 ? 'open' : '' }}">
                                    <a href="#" class="accordion__toggle collapsed h3" data-toggle="collapse"
                                        data-target="#course-toc-{{ $batchTopic->id }} " data-parent="#parent">
                                        <span class="flex">Topic : {{ $batchTopic->title }} </span>
                                        <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                                    </a>
                                    <div class="accordion__menu collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                        id="course-toc-{{ $batchTopic->id }}">
                                        @livewire('student.batch.lectures', ['batchTopic' => $batchTopic->id, 'batch' =>
                                        $batch], key($batchTopic->id))
                                    </div>
                                </div>
                            @empty
                                No Topics found
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> */ ?>
    <!-- // END Header Layout Content -->
</x-landing-layout>


