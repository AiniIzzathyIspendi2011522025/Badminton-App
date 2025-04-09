<div class="col-md-12 col-lg-12 animated fadeInRight" id="type-create" style="display:none">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><small>Tambah Data Tipe</small></h3>
            </div>
            {{ Form::open(array('url' => route('admin.field-type.store'), 'files' =>true)) }}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="name">Nama Tipe Lapangan</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="javascript:void(0)" onclick="$('#type-create').toggle(500);$('#type-edit').hide(500);">
                    <button class="btn btn-light" type="button">Back</button>
                </a>
                <a href="">
                    <button class="btn btn-success" type="submit">Save Data</button>
                </a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
