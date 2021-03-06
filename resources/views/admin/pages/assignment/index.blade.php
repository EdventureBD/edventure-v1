@extends('admin.layouts.default', [
'title' => 'Assignment',
'pageName'=>'Assignment Questions',
'secondPageName'=>'Assignment'
])

@section('css1')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <b>Course :</b> {{ $exam->course->title }}<br>
                                <b>Topic :</b> {{ $exam->topic->title }} <br>
                                <b>Assignment :</b> {{ $exam->title }}
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <div>
                                        <a href="{{ route('emptyAssignment') }}">
                                            <button type="button" class="btn btn-info">
                                                <i class="fas fa-download"></i> Download an empty csv file
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#modal-default">
                                            <i class="fas fa-plus-square"></i> Import from excel
                                        </button>

                                        <div class="modal fade" id="modal-default">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Import Question from Excel</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <p><span class="must-filled">N.B: </span>PLEASE CAREFULL WHILE
                                                        SELECTING THE FILE. YOU HAVE TO SELECT THE FILE CONTAINS THIS TOPIC
                                                        REGARDING THIS TOPIC</p>
                                                    <form action="{{ route('excelAddQuestion', $exam->slug) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Choose file:</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="file"
                                                                            class="custom-file-input" id="exampleInputFile">
                                                                        <label class="custom-file-label"
                                                                            for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Upload</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <a href="{{ route('addQuestion', $exam->slug) }}">
                                            <button class="btn btn-info"><i
                                                    class="fas fa-plus-square"></i>&nbsp;&nbsp;Assignment</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Question</th>
                                        <th>Image</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignments as $assignment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{!! $assignment->question !!}</td>
                                            <td>
                                                @if ($assignment->image)
                                                    <img class="product-image-thumb"
                                                        src="{{ Storage::url($assignment->image) }}" alt="">
                                                @endif
                                                {{-- <img src="{{ Storage::url($assignment->image) }}" alt="{{ $assignment->question }}"> --}}
                                            </td>
                                            <td>{{ $assignment->examTitle }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="mr-1"
                                                        href="{{ route('assignment.show', [$exam->slug, $assignment->slug]) }}"
                                                        title="See Details">
                                                        <button type="button" class="btn btn-info"><i
                                                                class="fas fa-eye"></i></button>
                                                    </a>
                                                    <a class="mr-1"
                                                        href="{{ route('assignment.edit', [$exam->slug, $assignment->slug]) }}"
                                                        title="Edit {{ $assignment->question }}">
                                                        <button class="btn btn-info"><i
                                                                class="far fa-edit"></i></button>
                                                    </a>
                                                    <a class="mr-1"
                                                        href="#deleteAssignment{{ $assignment->id }}" data-toggle="modal"
                                                        title="Delete {{ $assignment->question }}">
                                                        <button class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </a>
                                                    <div class="modal fade"
                                                        id="deleteAssignment{{ $assignment->id }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-danger">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete assignment
                                                                        {{ $assignment->question }}</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure??</p>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-outline-light"
                                                                        data-dismiss="modal">Close</button>
                                                                    <form
                                                                        action="{{ route('assignment.destroy', [$exam->slug, $assignment->slug]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="btn btn-outline-light">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL. No</th>
                                        <th>Question</th>
                                        <th>Image</th>
                                        <th>Exam</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js1')
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            $('.customControlInput').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                // console.log(id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "changeContentTagStatus",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success);
                    }
                });
            })
        })
    </script>
    <!-- DataTables -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}">
    </script>
@endsection

@section('js2')
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
