@extends('layouts.default')

@section('title') Thống kê nhân sự @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thống kê nhân sự</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Thống kê</li>
                                    <li class="breadcrumb-item active">Thống kê nhân sự</li>
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
                                <form method="GET" action="{{ route('statistic_users.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-3 mt-3">
                                            <select class="form-control select2" name="room_id">
                                                <option value="">Chọn phòng ban</option>
                                                @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3 mt-3">
                                            <select class="form-control select2" name="status">
                                                <option value="">Chọn trạng thái</option>
                                                <option value="0">Chưa có dự án</option>   
                                                <option value="1">Đang trong dự án</option>   
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
                                        <div class="col-sm-2 mt-3">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Thống kê
                                            </button>
                                        </div>
                                        
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                              <th style="width: 70px;" class="text-center">STT</th>
                                              <th>Ảnh đại diện</th>
                                              <th>Họ và tên</th>
                                              <th>Email</th>
                                              <th>Vai trò</th>
                                              <th>Phòng ban</th>
                                              <th>Công nghệ</th>
                                              <th>Dự án tham gia</th>
                                              <th>Giới tính</th>
                                              <th>Số điện thoại</th>
                                              <th>Số căn cước</th>
                                              <th>Ngày sinh</th>
                                              <th>Ngoại ngữ</th>
                                              <th>Kinh nghiệm</th>
                                              <th>Địa chỉ</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>
                                                        @if ($user->avatar)
                                                            <div>
                                                                <img class="rounded-circle avatar-xs" src="{{ asset($user->avatar) }}" alt="">
                                                            </div>
                                                        @else
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle text-uppercase">
                                                                    {{ substr($user->name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @foreach ($user->roles as $role)
                                                            <span class="badge badge-dark text-white">{{ $role->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $user->room->name }}</td>
                                                    <td>
                                                        @foreach ($user->techStacks as $techStack)
                                                            <p>{{ $techStack->name }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($user->projects as $project)
                                                            <p>{{ $project->name }}</p>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td>{{ $user->phone_number }}</td>
                                                    <td>{{ $user->card_id }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($user->birthday)) }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#foreign_language{{ $user->id }}">Xem</button>

                                                        <div class="modal fade" id="foreign_language{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Ngoại ngữ</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {!! $user->foreign_language !!}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#experience{{ $user->id }}">Xem</button>

                                                        <div class="modal fade" id="experience{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Kinh nghiệm</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {!! $user->experience !!}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->address }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $users->links() }}
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
@endpush

@push('css')
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush