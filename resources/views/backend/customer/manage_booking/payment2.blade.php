<div class="modal fade" id="modal-payment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Jadwal Lapangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-top">
                            <div class="row" style="padding:10px;">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Jenis Pembayaran : </label>
                                        <input type="radio" id="radio-lunas" name="status" value="1"
                                                class="custom-control-input radio-dp" checked>
                                            <label class="custom-control-label" for="radio-lunas">Bayar Lunas</label>

                                        <input type="radio" id="radio-dp" name="status" value="2"
                                            class="custom-control-input radio-dp">
                                        <label class="custom-control-label" for="radio-dp">Bayar DP</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Lapangan</label>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Jadwal</label>
                                    <span class="badge badge-danger"
                                        style="padding:10px 20px;float:right;background-color:#FF0000;">Tidak
                                        Tersedia</span>
                                    <span class="badge badge-light"
                                        style="padding:10px 20px;float:right">Tersedia</span>
                                    <span class="badge badge-info"
                                        style="padding:10px 20px;float:right;background-color:#6777EF;">Dipilih</span>
                                    <br>
                                    <div class="form-group" style="margin-top:10px;">

                                        <div class="selectgroup selectgroup-pills" id="hour-checkbox">

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div><!-- End .row -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Bayar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
