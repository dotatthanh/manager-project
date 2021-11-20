@extends('layouts.default')

@section('title') Quản lý nhân sự @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách nhân sự</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">Cài đặt</li>
                                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" title="Cài đặt" data-toggle="tooltip" data-placement="top">Nhân sự</a></li>
                                    <li class="breadcrumb-item active">Danh sách nhân sự</li>
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
                                <form method="GET" action="{{ route('users.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập họ và tên">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>

                                        {{-- @can('Thêm nhân sự') --}}
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('users.create') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm nhân sự</a>
                                            </div>
                                        </div><!-- end col-->
                                        {{-- @endcan --}}
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
                                                <th>Trung tâm</th>
                                                <th>Giới tính</th>
                                                <th>Số điện thoại</th>
                                                <th>Số căn cước</th>
                                                <th>Ngày sinh</th>
                                                <th>Ngoại ngữ</th>
                                                <th>Kinh nghiệm</th>
                                                <th>Địa chỉ</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle text-uppercase">
                                                                    {{ substr('a', 0, 1) }}
                                                                </span>
                                                            </div>
                                                    </td>
                                                    <td>Nguyễn Văn A</td>
                                                    <td>email@gmail.com</td>
                                                    <td>
                                                            <span class="badge badge-dark text-white">Admin</span>
                                                    </td>
                                                    <td>Trung tâm 1</td>
                                                    <td>Nam</td>
                                                    <td>0123123123</td>
                                                    <td>0123123123</td>
                                                    <td>11/11/1991</td>
                                                    <td>Tiếng Anh</td>
                                                    <td>3 năm</td>
                                                    <td>Đống Đa - Hà Nội</td>
                                                    <td class="text-center">
                                                        {{-- @if ($user->id != 1) --}}
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            {{-- @can('Chỉnh sửa nhân sự') --}}
                                                            <li class="list-inline-item px">
                                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                            </li>
                                                            {{-- @endcan --}}

                                                            {{-- @can('Xóa nhân sự') --}}
                                                            <li class="list-inline-item px">
                                                                <form method="post" action="{{ route('users.destroy', 1) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    
                                                                    <button type="button" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                </form>
                                                            </li>
                                                            {{-- @endcan --}}
                                                        </ul>
                                                        {{-- @endif --}}
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>

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