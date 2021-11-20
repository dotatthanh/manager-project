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
					<label for="name">Khách hàng <span class="text-danger">*</span></label>
					<select 
						name="customers[]" 
						id="addCustomer" 
						class="select2 select2-multiple form-control"
						multiple
						data-placeholder="Chọn khách hàng ..."
						>
						<option value="1">khách hàng 1</option>   
						<option value="2">khách hàng 2</option>   
						<option value="3">khách hàng 3</option>   
					</select>
					{!! $errors->first('name', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
					<label for="name">Nhân sự <span class="text-danger">*</span></label>
					<select 
						name="users[]" 
						id="addUser" 
						class="select2 select2-multiple form-control"
						multiple
						data-placeholder="Chọn nhân sự ..."
						>
						<option value="1">Nhân sự 1</option>   
						<option value="2">Nhân sự 2</option>   
						<option value="3">Nhân sự 3</option>   
					</select>
					{!! $errors->first('name', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
					<label for="name">Công nghệ <span class="text-danger">*</span></label>
					<select 
						name="tech_stacks[]" 
						id="addTechStack" 
						class="select2 select2-multiple form-control"
						multiple
						data-placeholder="Chọn công nghệ ..."
						>
						<option value="1">Công nghệ 1</option>   
						<option value="2">Công nghệ 2</option>   
						<option value="3">Công nghệ 3</option>   
					</select>
					{!! $errors->first('name', '<span class="error">:message</span>') !!}
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Loại dự án <span class="text-danger">*</span></label>
					<select 
						name="types[]" 
						id="addType" 
						class="select2 select2-multiple form-control"
						multiple
						data-placeholder="Chọn loại dự án ..."
						>
						<option value="1">loại dự án 1</option>   
						<option value="2">loại dự án 2</option>   
						<option value="3">loại dự án 3</option>   
					</select>
					{!! $errors->first('name', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
					<label for="name">Trạng thái <span class="text-danger">*</span></label>
					<select 
						name="roles[]" 
						id="addRole" 
						class="select2 select2-multiple form-control"
						multiple
						data-placeholder="Chọn trạng thái ..."
						>
						<option value="1">Trạng thái 1</option>   
						<option value="2">Trạng thái 2</option>   
						<option value="3">Trạng thái 3</option>   
					</select>
					{!! $errors->first('name', '<span class="error">:message</span>') !!}
				</div>

				<div class="form-group">
					<label for="name">Trung tâm <span class="text-danger">*</span></label>
					<select 
						name="centers[]" 
						id="addCenter" 
						class="select2 select2-multiple form-control"
						multiple
						data-placeholder="Chọn trung tâm ..."
						>
						<option value="1">Trung tâm 1</option>   
						<option value="2">Trung tâm 2</option>   
						<option value="3">Trung tâm 3</option>   
					</select>
					{!! $errors->first('name', '<span class="error">:message</span>') !!}
				</div>

			</div>
		</div>
	</div>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Mô tả</h4>

        <textarea id="description" class="summernote mb-2" name="description">{{ isset($data_edit->description) ? $data_edit->description : '' }}</textarea>

        <div class="mt-3">
        	<button type="button" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        	<a href="{{ route('projects.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>