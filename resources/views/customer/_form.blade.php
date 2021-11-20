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
                    <label for="name">Trong số ưu tiên <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Trong số ưu tiên" value="{{ old('name', $data_edit->name ?? '') }}">
                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-6">
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
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Mô tả</h4>

        <textarea id="description" class="summernote mb-2" name="description">{{ isset($data_edit->description) ? $data_edit->description : '' }}</textarea>

        <div class="mt-3">
            <button type="button" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
            <a href="{{ route('types.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
        </div>
    </div>

</div>