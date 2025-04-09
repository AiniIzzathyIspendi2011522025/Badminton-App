<div class="col-md-12 col-lg-12 animated fadeInRight" id="type-edit" style="display:none">

    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><small>Edit Data Tipe</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {{ Form::open(array('method'=>'PATCH','url'=>route('admin.field-type.update',0),'id'=>'type-update', 'files' =>true)) }}
            <div class="card-body">

                <div class="row">
                <div class="form-group col-md-12">
                <label for="name">Nama Tipe Lapangan</label>
                <input name="name" type="text"  class="form-control" id="e_name" placeholder="">
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
            </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="javascript:void(0)" onclick="$('#type-edit').toggle(500);$('#type-create').hide(500);">
                <button class="btn btn-light" type="button">Back</button>
            </a>
            <a href="">
                <button class="btn btn-success" type="submit">Save</button>
            </a>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.card -->
    </div>
</div>
