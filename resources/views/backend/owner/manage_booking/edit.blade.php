<div class="modal fade" id="modal-editbooking">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Transaksi Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(array('method'=>'PATCH', 'url' => route('owner.booking.update', 0), 'id' => 'edit-booking')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Penyewa</label>
                            <input type="text" id="e_tenant_name" class="form-control" name="tenant_name" placeholder="Inputkan nama penyewa">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal </label>
                            <input type="date" class="form-control" name="date" id="e_date" onchange="dateChange()">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Pilih Venue</label>
                            {!! Form::select('venue', $venue,null, ['class' => 'form-control kt-select2
                            myselect2','required'=>'required','id'=>'e_venue']) !!}
                            @error('venue')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Pilih Lapangan</label>
                            {!! Form::select('field', $field,null, ['class' => 'form-control kt-select2
                            myselect2','required'=>'required','id'=>'e_field']) !!}
                            @error('field')
                            <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>Pilih Jadwal Lapangan</label>
                            <span class="badge badge-danger" style="padding:10px 20px;float:right;background-color:#FF0000;">Tidak Tersedia</span>
                            <span class="badge badge-light" style="padding:10px 20px;float:right">Tersedia</span>
                            <span class="badge badge-info" style="padding:10px 20px;float:right;background-color:#6777EF;">Dipilih</span>
                            <div class="form-group">

                                <div class="selectgroup selectgroup-pills" id="hour-checkbox-edit">
                                    <!-- <label class="selectgroup-item">
                                        <input type="checkbox" name="value" value="HTML" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button" style="background-color:red">
                                            <b>3131</b><br>
                                            <b>55K</b>
                                        </span>
                                    </label> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Booking</button>
            </div>
            {!! Form::close() !!}
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
