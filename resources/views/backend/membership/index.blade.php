@extends('layouts.landing.home')

@section('content')
<div class="page-header text-center">
  <div class="container">
    <h1 class="page-title" style="background-color:white;">
      Detail Pembayaran Membership<span>Membership</span>
    </h1>
  </div>
</div>

<div class="page-content">
  <div class="cart">
    <div class="container">
      <form action="/membership/{{ $venue->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-7">
            <table class="table table-cart table-mobile">
              <thead>
                <tr>
                  <th>Venue</th>
                  <th>Harga</th>
                  <th>Durasi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $venue->name }}</td>
                  <td id="harga">{{ Helper::rupiah($venue->membership_price) }}</td>
                  <td>
                    <select id="durasi" name="duration" class="form-control" required>
                      <option value="1">1 Bulan</option>
                      <option value="12">1 Tahun</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <aside class="col-lg-5">
            <div class="summary summary-cart">
              <h3 class="summary-title">Detail</h3>
              <table class="table table-summary">
                <tbody>
                  <tr>
                    <td>Nama :</td>
                    <td>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</td>
                  </tr>
                  <tr>
                    <td>Tanggal :</td>
                    <td>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
                  </tr>
                  <tr class="summary-total">
                    <td>Total :</td>
                    <td id="total-harga">{{ Helper::rupiah($venue->membership_price) }}</td>
                  </tr>

                  <tr>
                    <td colspan="2">Metode Pembayaran :</td>
                  </tr>
                  @foreach ($venue->paymentMethodDetail as $paymentMethodDetail)
                  <tr>
                    <td>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="bank-{{ $paymentMethodDetail->payment_method_id }}"
                               name="payment_method" value="{{ $paymentMethodDetail->id }}" required
                               class="custom-control-input">
                        <label class="custom-control-label"
                               for="bank-{{ $paymentMethodDetail->payment_method_id }}">
                          {{ $paymentMethodDetail->PaymentMethod->name }} ({{ $paymentMethodDetail->no_rek }})
                        </label>
                      </div>
                    </td>
                  </tr>
                  @endforeach

                  <tr>
                    <td colspan="2">Bukti Pembayaran :</td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <input type="file" name="payment" accept="image/*" class="form-control">
                    </td>
                  </tr>
                </tbody>
              </table>

              <div id="submit">
                <button type="submit" class="btn btn-success btn-order btn-block rounded">Bayar</button>
              </div>
            </div>
          </aside>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Script untuk update total harga --}}
<script>
  const hargaDasar = {{ $venue->membership_price }};
  const selectDurasi = document.getElementById('durasi');
  const totalHarga = document.getElementById('total-harga');

  function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
  }

  selectDurasi.addEventListener('change', function () {
    const bulan = parseInt(this.value);
    const total = hargaDasar * bulan;
    totalHarga.textContent = formatRupiah(total);
  });
</script>
@endsection
