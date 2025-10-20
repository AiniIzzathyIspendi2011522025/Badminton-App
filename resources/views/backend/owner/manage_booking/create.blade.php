@php
    $found = session('booking.membership');
@endphp

<div class="modal fade" id="modal-booking">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Transaksi Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{-- ALERTS --}}
                @if (session('success_message'))
                    <div class="alert alert-success">{{ session('success_message') }}</div>
                @endif
                @if (session('info_message'))
                    <div class="alert alert-info">{{ session('info_message') }}</div>
                @endif
                @if ($errors->has('id') || $errors->has('venue_id'))
                    <div class="alert alert-danger">
                        {{ $errors->first('venue_id') ?: $errors->first('id') }}
                    </div>
                @endif

                {{-- FORM CEK MEMBERSHIP (hanya tampil jika belum ditemukan) --}}
                @unless ($found)
                    <form method="POST" action="{{ route('owner.membership.check') }}" class="mb-3"
                        id="form-check-membership">
                        @csrf
                        <div class="form-row">
                            <div class="col-sm-6">
                                <label for="venue_id">Pilih Venue</label>
                                {!! Form::select('venue_id', $venue, old('venue_id'), [
                                    'class' => 'form-control kt-select2 myselect2 ' . ($errors->has('venue_id') ? 'is-invalid' : ''),
                                    'required' => 'required',
                                    'id' => 'venue_id',
                                ]) !!}
                            </div>
                            <div class="col-sm-6">
                                <label for="m_id">Cek Membership (ID)</label>
                                <input type="text" id="m_id" name="id"
                                    class="form-control @error('id') is-invalid @enderror"
                                    placeholder="Contoh: GSP-20251018-969" value="{{ old('id') }}">
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary">Cek Membership</button>
                            </div>
                        </div>
                    </form>
                @endunless

                {{-- INFO MEMBERSHIP DITEMUKAN --}}
                @if ($found)
                    <div class="card mb-3" id="membership-summary">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="font-weight-bold">ID: {{ $found['id'] }}</div>
                                <div>Nama: {{ $found['user_name'] ?: '-' }}</div>
                                <div>Venue: {{ $found['venue_name'] ?: '-' }}</div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="badge
                  {{ (int) $found['status'] === 1
                      ? 'badge-success'
                      : ((int) $found['status'] === 2
                          ? 'badge-info'
                          : 'badge-secondary') }}">
                                    {{ (int) $found['status'] === 1 ? 'AKTIF' : ((int) $found['status'] === 2 ? 'SEDANG DIPROSES' : 'TIDAK AKTIF') }}
                                </span>
                                <div class="small mt-2">
                                    {{ $found['start_date'] ?: '-' }} s/d {{ $found['end_date'] ?: '-' }}
                                </div>

                                {{-- Tombol Cancel Membership --}}
                                <form method="POST" action="{{ route('owner.membership.cancel') }}" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- FORM BOOKING --}}
                {{ Form::open(['method' => 'POST', 'url' => route('owner.booking.store')]) }}
                <input type="hidden" class="form-control" name="membership_discount"
                    value="{{ $found['membership_discount'] ?? '' }}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Penyewa</label>
                            <input type="text" class="form-control" name="tenant_name"
                                placeholder="Inputkan nama penyewa" value="{{ $found['user_name'] ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal </label>
                            <input type="date" class="form-control" name="date" id="c_date"
                                onchange="dateChange()">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Pilih Venue</label>
                            {!! Form::select('venue', $venue, $found['venue_id'] ?? old('venue'), [
                                'class' => 'form-control kt-select2 myselect2',
                                'required' => 'required',
                                'id' => 'c_venue',
                                // Jika ingin mengunci venue setelah membership ditemukan:
                                // 'disabled' => $found ? true : false
                            ]) !!}
                            @error('venue')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Pilih Lapangan</label>
                            {!! Form::select('field', $field, null, [
                                'class' => 'form-control kt-select2 myselect2',
                                'required' => 'required',
                                'id' => 'c_field',
                            ]) !!}
                            @error('field')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Jadwal --}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Pilih Jadwal Lapangan</label>
                            <span class="badge badge-danger"
                                style="padding:10px 20px;float:right;background-color:#FF0000;">Tidak Tersedia</span>
                            <span class="badge badge-light" style="padding:10px 20px;float:right">Tersedia</span>
                            <span class="badge badge-info"
                                style="padding:10px 20px;float:right;background-color:#6777EF;">Dipilih</span>
                            <div class="form-group">
                                <div class="selectgroup selectgroup-pills" id="hour-checkbox">
                                    {{-- render jam di sini --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> {{-- /modal-body --}}

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Booking</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>

{{-- Auto buka modal jika ada pesan --}}
@if (session('success_message') || session('info_message') || $errors->has('id') || $errors->has('venue_id'))
    <script>
        $(function() {
            $('#modal-booking').modal('show');
        });
    </script>
@endif
