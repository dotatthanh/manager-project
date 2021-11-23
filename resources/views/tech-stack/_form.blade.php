<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Tên công nghệ <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Tên công nghệ" value="{{ old('name', $data_edit->name ?? '') }}">
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                </div>
                    
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                    <select class="form-control select2" name="status">
                        <option value="">Chọn trạng thái</option>
                        <option value="0" {{ isset($data_edit->status) && $data_edit->status == 0 ? 'selected' : '' }}>Chưa kích hoạt</option>
                        <option value="1" {{ isset($data_edit->status) && $data_edit->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                    </select>
                    {!! $errors->first('status', '<span class="error">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Mô tả <span class="text-danger">*</span></h4>

        <textarea id="description" class="summernote mb-2" name="description">{{ isset($data_edit->description) ? $data_edit->description : '' }}</textarea>
        {!! $errors->first('description', '<span class="error">:message</span>') !!}

        <div class="mt-3">
            <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
            <a href="{{ route('types.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>