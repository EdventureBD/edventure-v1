@extends('admin.layouts.default', [
                                    'title'=>'CQ', 
                                    'pageName'=>'Create CQ', 
                                    'secondPageName'=>'Create CQ'
                                ])
@section('css1')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

    <script>
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }
    
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

@section('content')
    {{-- @livewire('exam.cq', ['exam'=>$exam]) --}}
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Create CQ</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form"  method="POST" action="{{ route('cq.store', $exam) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="examId" type="hidden" value="{{ $exam->id }}">
                                <input name="slug" type="hidden" value="{{ $exam->slug }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="question" class="col-form-label">Question <span class="must-filled">*</span></label>
                                            <input type="text" class="form-control" name="question" value="{{ old('question') }}" placeholder="Enter question">
                                            @error('question')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="exampleInputFile" class="col-form-label">Choose Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="image" class="custom-file-input hidden" id="exampleInputFile" onchange="previewFile(this);" >
                                                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <p style="color: red;">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <img class="product-image" src="http://placehold.it/150x100" id="previewImg" class="avatar" alt="...">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="marks">Marks <span class="must-filled">*</span></label>
                                            <input type="text" id="marks" class="form-control" name="marks" value="{{ old('marks') }}" placeholder="Enter marks">
                                            @error('marks')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputFile" class="col-form-label">Choose anser pdf file <span class="must-filled">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="answer" class="custom-file-input hidden" id="exampleInputFile" >
                                                    <label class="custom-file-label" for="exampleInputFile">Choose answer pdf</label>
                                                </div>
                                            </div>
                                            @error('answer')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="examId">Exam <span class="must-filled">*</span></label>
                                            <select class="form-control" name="examId" disabled>
                                                <option value="{{ $exam->id }}" selected>{{ $exam->title }} -> {{ $exam->id }}</option>
                                            </select>
                                            @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="examId">Content Tag <span class="must-filled">*</span></label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple name="contentTagIds[]" data-placeholder="Select a Content Tag" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            @foreach ($contentTags as $contentTag)
                                                <option value="{{ $contentTag->id }}">{{ $contentTag->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('contentTagIds')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="javascript:history.back()"><button type="button" class="btn btn-danger">Back</button></a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection 

@section('js1')
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
@endsection

@section('js2')
    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })

        })
    </script>
@endsection