<div class="col-md-12 col-lg-12 animated fadeInRight" id="facility-create" style="display:none">

    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><small>Tambah Data Fasilitas</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {{ Form::open(array('url' => route('admin.facility.store'), 'files' =>true)) }}
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="name">Nama Fasiltas</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="">
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
                            <input name="icon" type="text" class="form-control" id="icon" placeholder="">
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
                <a href="javascript:void(0)" onclick="$('#facility-create').toggle(500);$('#facility-edit').hide(500);">
                    <button class="btn btn-light" type="button">Back</button>
                </a>
                <a href="">
                    <button class="btn btn-success" type="submit">Save </button>
                </a>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.card -->
    </div>
</div>
