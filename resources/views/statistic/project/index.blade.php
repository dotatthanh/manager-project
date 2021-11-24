@extends('layouts.default')

@section('title') Thống kê dự án @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thống kê dự án</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Thống kê</li>
                                    <li class="breadcrumb-item active">Thống kê dự án</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('statistic_projects.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-3 mt-3">
                                            <select class="form-control select2" name="type_id">
                                                <option value="">Chọn loại dự án</option>
                                                @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-3 mt-3">
                                            <select class="form-control select2" name="room_id">
                                                <option value="">Chọn phòng ban</option>
                                                @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3 mt-3">
                                            <select name="tech_stacks[]" id="addTechStack" class="select2 select2-multiple form-control" multiple data-placeholder="Chọn công nghệ ...">
                                                @foreach ($tech_stacks as $tech_stack)
                                                    <option value="{{ $tech_stack->id }}">
                                                        {{ $tech_stack->name }}
                                                    </option>
                                                @endforeach        
                                            </select>
                                        </div>
                                        <div class="col-sm-3 mt-3">
                                            <select name="users[]" id="addUser" class="select2 select2-multiple form-control" multiple data-placeholder="Chọn nhân sự ...">
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                                @endforeach        
                                            </select>
                                        </div>
                                        <div class="col-sm-3 mt-3">
                                            <div class="docs-datepicker">
                                                <div class="input-group">
                                                    <input type="text" class="form-control docs-date" name="start_date" placeholder="Chọn ngày bắt đầu" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="docs-datepicker-container"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 mt-3">
                                            <div class="docs-datepicker">
                                                <div class="input-group">
                                                    <input type="text" class="form-control docs-date" name="end_date" placeholder="Chọn ngày kết thúc" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="docs-datepicker-container"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 mt-3">
                                            <select class="form-control select2" name="status">
                                                <option value="">Chọn trạng thái</option>
                                                <option value="0">Chưa triển khai</option>   
                                                <option value="1">Đang triển khai</option>   
                                                <option value="2">Hoàn thành</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2 mt-3">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>
                                        
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Tên dự án</th>
                                                <th>Loại dự án</th>
                                                <th>Mô tả</th>
                                                <th>Khách hàng</th>
                                                <th>Phòng ban</th>
                                                <th>Công nghệ</th>
                                                <th>Nhân sự</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Tiến độ</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($projects as $project)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $project->name }}</td>
                                                    <td>{{ $project->type->name }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#description{{ $project->id }}">Xem</button>

                                                        <div class="modal fade" id="description{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Mô tả</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {!! $project->description !!}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $project->customer->name }}</td>
                                                    <td>{{ $project->room->name }}</td>
                                                    <td>
                                                        @foreach ($project->techStacks as $techStack)
                                                            <p>{{ $techStack->name }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($project->users as $user)
                                                            <p>{{ $user->name }}</p>
                                                        @endforeach
                                                    </td>
                                                    </td>
                                                    <td>{{ date("d-m-Y", strtotime($project->start_date)) }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($project->end_date)) }}</td>
                                                    <td>{{ $project->progress }}%</td>
                                                    <td>
                                                        @if($project->status == 0)
                                                            Chưa triển khai
                                                        @elseif($project->status == 1)
                                                            Đang triển khai
                                                        @elseif($project->status == 2)
                                                            Hoàn thành
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Skote.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('js')
    <!-- select 2 plugin -->
    <script src="{{ asset('libs\select2\js\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('js\pages\ecommerce-select2.init.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-timepicker\js\bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-touchspin\jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-maxlength\bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ asset('js\pages\form-advanced.init.js') }}"></script>

    <script type="text/javascript">
        $('.docs-date').datepicker({
            format: 'dd-mm-yyyy',
        });
    </script>
@endpush

@push('css')
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">

    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush