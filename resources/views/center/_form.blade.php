<div class="card">
	<div class="card-body">

		<h4 class="card-title">Thông tin cơ bản</h4>
		<p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
		@csrf
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="name">Tên trung tâm phụ trách <span class="text-danger">*</span></label>
					<input id="name" name="name" type="text" class="form-control" placeholder="Tên trung tâm phụ trách" value="{{ old('name', $data_edit->name ?? '') }}">
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
        	<a href="{{ route('centers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>