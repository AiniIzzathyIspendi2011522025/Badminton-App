<div class="col-md-12 col-lg-12 animated fadeInRight" id="facility-edit" style="display:none">
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><small>Edit Data Fasilitas</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {{ Form::open(array('method'=>'PATCH','url'=>route('admin.facility.update',0),'id'=>'facility-update', 'files' =>true)) }}
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="name">Nama Fasiltas</label>
                            <input name="name" type="text" class="form-control" id="e_name" placeholder="">
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input name="icon" type="text" class="form-control" id="e_icon" placeholder="">
                            @error('icon')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="javascript:void(0)" onclick="$('#facility-edit').toggle(500);$('#facility-create').hide(500);">
                    <button class="btn btn-light" type="button">Back</button>
                </a>
                <a href="">
                    <button class="btn btn-primary" type="submit">Save Data</button>
                </a>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.card -->
    </div>
</div>