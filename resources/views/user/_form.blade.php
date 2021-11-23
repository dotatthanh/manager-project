<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Họ và tên <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Họ và tên" value="{{ old('name', $data_edit->name ?? '') }}">
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="gender">Giới tính <span class="text-danger">*</span></label>
                    <div class="form-check form-check">
                        <input type="radio" class="form-check-input" id="nam" name="gender" value="Nam" {{ isset($data_edit->gender) && $data_edit->gender == 'Nam' ? 'checked' : '' }} checked>
                        <label class="form-check-label" for="nam">Nam</label>
                    </div>
                    <div class="form-check form-check">
                        <input type="radio" class="form-check-input" id="nu" name="gender" value="Nữ" {{ isset($data_edit->gender) && $data_edit->gender == 'Nữ' ? 'checked' : '' }}>
                        <label class="form-check-label" for="nu">Nữ</label>
                    </div>
                    {!! $errors->first('gender', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="birthday">Ngày sinh <span class="text-danger">*</span></label>
                    <div class="docs-datepicker">
                        <div class="input-group">
                            <input type="text" class="form-control docs-date" name="birthday" placeholder="Chọn ngày sinh" autocomplete="off" value="{{ old('birthday', isset($data_edit->birthday) ? date('d-m-Y', strtotime($data_edit->birthday)) : '') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="docs-datepicker-container"></div>
                    </div>
                    {!! $errors->first('birthday', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email', $data_edit->email ?? '') }}">
                    {!! $errors->first('email', '<span class="error">:message</span>') !!}
                </div>
                
                @if ($routeType == 'create')

                    <div class="form-group">
                        <label for="userpassword">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="userpassword" placeholder="Nhập mật khẩu" autocomplete="new-password" name="password">
                        {!! $errors->first('password', '<span class="error">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Nhập xác nhận mật khẩu" name="password_confirmation">        
                    </div>
                @endif

                <div class="form-group">
                    <label for="role">Vai trò <span class="text-danger">*</span></label>
                    <select 
                        name="roles[]" 
                        id="addRole" 
                        class="select2 select2-multiple form-control"
                        multiple
                        data-placeholder="Chọn vai trò ..."
                    >
                        @foreach ($roles as $item)
                            <option 
                                {{ isset($data_edit) && in_array($item->id, $data_edit->roles->pluck('id')->toArray()) ?
                                'selected' : '' }} 
                                value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach        
                    </select>
                    {!! $errors->first('roles', '<span class="error">:message</span>') !!}
                </div>

            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="room_id">Phòng ban <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="room_id">
                        <option value="">Chọn phòng ban</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ isset($data_edit->room_id) && $data_edit->room_id == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('room_id', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="tech_stack_id">Công nghệ <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="tech_stack_id">
                        <option value="">Chọn công nghệ</option>
                        @foreach ($tech_stacks as $tech_stack)
                            <option value="{{ $tech_stack->id }}" {{ isset($data_edit->tech_stack_id) && $data_edit->tech_stack_id == $tech_stack->id ? 'selected' : '' }}>{{ $tech_stack->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('tech_stack_id', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="avatar">Ảnh đại diện</label>
                    <input id="avatar" name="avatar" type="file" class="form-control">
                    {!! $errors->first('avatar', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="phone_number">Số điện thoại <span class="text-danger">*</span></label>
                    <input id="phone_number" name="phone_number" type="number" class="form-control" placeholder="Số điện thoại" value="{{ old('phone_number', $data_edit->phone_number ?? '') }}">
                    {!! $errors->first('phone_number', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="card_id">Số điện thoại <span class="text-danger">*</span></label>
                    <input id="card_id" name="card_id" type="text" class="form-control" placeholder="Số điện thoại" value="{{ old('card_id', $data_edit->card_id ?? '') }}">
                    {!! $errors->first('card_id', '<span class="error">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ <span class="text-danger">*</span></label>
                    <input id="address" name="address" type="text" class="form-control" placeholder="Địa chỉ" value="{{ old('address', $data_edit->address ?? '') }}">
                    {!! $errors->first('address', '<span class="error">:message</span>') !!}
                </div>

            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Ngoại ngữ <span class="text-danger">*</span></h4>

        <textarea id="foreign_language" class="summernote mb-2" name="foreign_language">{{ isset($data_edit->foreign_language) ? $data_edit->foreign_language : '' }}</textarea>
        {!! $errors->first('foreign_language', '<span class="error">:message</span>') !!}
    </div>

</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Kinh nghiệm <span class="text-danger">*</span></h4>

        <textarea id="experience" class="summernote mb-2" name="experience">{{ isset($data_edit->experience) ? $data_edit->experience : '' }}</textarea>
        {!! $errors->first('experience', '<span class="error">:message</span>') !!}

        <div class="mt-3">
            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
            <a href="{{ route('types.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>