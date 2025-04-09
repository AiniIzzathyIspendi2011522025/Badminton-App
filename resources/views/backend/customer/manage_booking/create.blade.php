    <div id="jadwal-lapangan" class="mb-5">
        <div class="border" style="border-radius: 16px; box-shadow:rgba(37, 40, 43, 0.08) 0px 1px 6px 0px">
            <div class="modal-header">
                <h4 class="modal-title">Detail Jadwal</h4>
            </div>
            {{ Form::open(['method' => 'POST', 'url' => route('customer.payment.booking'), 'files' => true]) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-top">
                            <div class="row" style="padding:10px;">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Tanggal </label>
                                        <input type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                            class="form-control" name="date" id="c_date" onchange="dateChange()">
                                        <input type="hidden" id="c_venue" value="{{ $venue->id }}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Lapangan</label>
                                        {!! Form::select('select_field', $select_field, null, [
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            'id' => 'c_select_field',
                                        ]) !!}
                                        @error('select_field')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
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
                            <!-- <div class="form-group col-md-5">
                                <label>Jenis pembayaran</label><br>
                                <input type="radio" id="rent" name="status" value="1" checked>
                                <label for="rent">Bayar lunas</label>
                                <input type="radio" id="booking" name="status" value="2">
                                <label for="booking">Bayar dp</label>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" name="price" id="price" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12" style="display:none" id="col-dp">
                                <div class="form-group">
                                    <label>Dp</label>
                                    <input type="text" class="form-control" name="dp" id="dp" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label>Bukti Pembayaran</label><br>
                                <input type="file" id="payment" name="payment"
                                    accept="image/*"
                                    class="form-control-sm validate">
                            </div> -->
                        </div><!-- End .product-details-top -->
                    </div><!-- End .col-lg-9 -->


                </div><!-- End .row -->
            </div>
            <div class="modal-footer justify-content-between">
                @if (Auth::user())
                    <button type="submit" style="border-radius: 6px" class="btn btn-primary mx-auto d-block">
                        <span>Booking</span>
                    </button>
                @else
                    <button type="button" style="border-radius: 6px"
                        class="btn btn-primary mx-auto d-block toastrDefaultWarning"><span>
                            Booking</span></button>
                @endif
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
