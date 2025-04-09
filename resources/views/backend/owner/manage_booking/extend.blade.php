<div class="modal fade" id="modal-extend">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Perpanjang Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(array('method'=>'POST', 'url' => route('owner.extend.extendBooking', $rents->id))) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>Jadwal Lapangan</label>
                            <span class="badge badge-danger" style="padding:10px 20px;float:right">Tidak Tersedia</span>
                            <span class="badge badge-light" style="padding:10px 20px;float:right">Tersedia</span>
                            <span class="badge badge-info" style="padding:10px 20px;float:right">Dipilih</span>
                            <div class="form-group">

                                <div class="selectgroup selectgroup-pills" id="hour-checkbox">
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
                <button type="submit" class="btn btn-success">Perpanjang Booking</button>
            </div>
            {!! Form::close() !!}
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
