<div class="card">
	<div class="card-body">

		<h4 class="card-title">Thông tin cơ bản</h4>
		<p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
		@csrf
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Tên dự án <span class="text-danger">*</span></label>
					<input id="name" name="name" type="text" class="form-control" placeholder="Tên dự án" value="{{ old('name', $data_edit->name ?? '') }}">
					{!! $errors->first('name', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
					<label for="customer_id">Khách hàng <span class="text-danger">*</span></label>
					<select class="form-control select2" name="customer_id">
                        <option value="">Chọn khách hàng</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ isset($data_edit->customer_id) && $data_edit->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
					{!! $errors->first('customer_id', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
					<label for="users">Nhân sự <span class="text-danger">*</span></label>
					<select name="users[]" id="addUser" class="select2 select2-multiple form-control" multiple data-placeholder="Chọn nhân sự ...">
                        @foreach ($users as $item)
                            <option 
                                {{ isset($data_edit) && in_array($item->id, $data_edit->users->pluck('id')->toArray()) ?
                                'selected' : '' }} 
                                value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach        
                    </select>
					{!! $errors->first('users', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
					<label for="tech_stacks">Công nghệ <span class="text-danger">*</span></label>
                    <select name="tech_stacks[]" id="addTechStack" class="select2 select2-multiple form-control" multiple data-placeholder="Chọn công nghệ ...">
                        @foreach ($tech_stacks as $item)
                            <option 
                                {{ isset($data_edit) && in_array($item->id, $data_edit->tech_stacks->pluck('id')->toArray()) ?
                                'selected' : '' }} 
                                value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach        
                    </select>
					{!! $errors->first('tech_stacks', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
                    <label for="start_date">Ngày bắt đầu <span class="text-danger">*</span></label>
                    <div class="docs-datepicker">
                        <div class="input-group">
                            <input type="text" class="form-control docs-date" name="start_date" placeholder="Chọn ngày bắt đầu" autocomplete="off" value="{{ old('start_date', isset($data_edit->start_date) ? date('d-m-Y', strtotime($data_edit->start_date)) : '') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="docs-datepicker-container"></div>
                    </div>
                    {!! $errors->first('start_date', '<span class="error">:message</span>') !!}
                </div>
                @if ($routeType == 'update')
                <div class="form-group">
					<label for="progress">Tiến độ (%) <span class="text-danger">*</span></label>
					<div class="row">
						<div class="col-10 mb-3 ">
							<input name="progress" type="number" class="form-control" placeholder="Tiến độ" value="{{ old('progress', $data_edit->progress ?? '') }}">
							{!! $errors->first('progress', '<span class="error">:message</span>') !!}
						</div>
						<div class="col-2 mb-3 ">
							<input type="text" class="form-control text-center" value="%" disabled>
						</div>
					</div>
					{!! $errors->first('progress', '<span class="error">:message</span>') !!}
				</div>
				@endif
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label for="type_id">Loại dự án <span class="text-danger">*</span></label>
					<select class="form-control select2" name="type_id">
                        <option value="">Chọn loại dự án</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ isset($data_edit->type_id) && $data_edit->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
					{!! $errors->first('type_id', '<span class="error">:message</span>') !!}
				</div>

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
					<label for="status">Trạng thái <span class="text-danger">*</span></label>
					<select class="form-control select2" name="status">
                        <option value="">Chọn trạng thái</option>
                        <option value="0" {{ isset($data_edit->status) && $data_edit->status == 0 ? 'selected' : '' }}>Chưa triển khai</option>   
						<option value="1" {{ isset($data_edit->status) && $data_edit->status == 1 ? 'selected' : '' }}>Đang triển khai</option>   
						<option value="2" {{ isset($data_edit->status) && $data_edit->status == 2 ? 'selected' : '' }}>Hoàn thành</option>
                    </select>
					{!! $errors->first('status', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
                    <label for="priority">Trong số ưu tiên <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="priority">
                        <option value="">Chọn trong số ưu tiên</option>
                        <option value="Cấp 1" {{ isset($data_edit->priority) && $data_edit->priority == 'Cấp 1' ? 'selected' : '' }}>Cấp 1</option>
                        <option value="Cấp 2" {{ isset($data_edit->priority) && $data_edit->priority == 'Cấp 2' ? 'selected' : '' }}>Cấp 2</option>
                        <option value="Cấp 3" {{ isset($data_edit->priority) && $data_edit->priority == 'Cấp 3' ? 'selected' : '' }}>Cấp 3</option>
                        <option value="Cấp 4" {{ isset($data_edit->priority) && $data_edit->priority == 'Cấp 4' ? 'selected' : '' }}>Cấp 4</option>
                        <option value="Cấp 5" {{ isset($data_edit->priority) && $data_edit->priority == 'Cấp 5' ? 'selected' : '' }}>Cấp 5</option>
                    </select>
                    {!! $errors->first('priority', '<span class="error">:message</span>') !!}
                </div>

				<div class="form-group">
                    <label for="end_date">Ngày kết thúc <span class="text-danger">*</span></label>
                    <div class="docs-datepicker">
                        <div class="input-group">
                            <input type="text" class="form-control docs-date" name="end_date" placeholder="Chọn ngày kết thúc" autocomplete="off" value="{{ old('end_date', isset($data_edit->end_date) ? date('d-m-Y', strtotime($data_edit->end_date)) : '') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="docs-datepicker-container"></div>
                    </div>
                    {!! $errors->first('end_date', '<span class="error">:message</span>') !!}
                </div>

			</div>
		</div>
	</div>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Mô tả</h4>

        <textarea id="description" class="summernote mb-2" name="description">{{ isset($data_edit->description) ? $data_edit->description : '' }}</textarea>
        {!! $errors->first('description', '<span class="error">:message</span>') !!}

        <div class="mt-3">
        	<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        	<a href="{{ route('projects.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>