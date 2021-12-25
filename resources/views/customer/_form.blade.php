<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Tên khách hàng <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Tên khách hàng" value="{{ old('name', $data_edit->name ?? '') }}">
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
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
            <a href="{{ route('customers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>