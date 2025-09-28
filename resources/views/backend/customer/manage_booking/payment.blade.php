@extends('layouts.landing.home')

@section('content')
    <div class="page-header text-center" style="background-image: url('{{ asset('images/field/' . $rent->Field->image) }}')">
        <div class="container">
            <h1 class="page-title" style="background-color:white;">
                Detail Pemesanan<span>Booking</span>
            </h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">

    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        @php
                            $hoursBooked   = $rent->RentDetail->count();                           // jumlah jam dibooking
                            $oneHourPrice  = optional($rent->RentDetail->first())->OpeningHourDetail->price ?? 0; // harga 1 jam
                        @endphp

                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Lapangan</th>
                                    <th>Waktu</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{ Form::open(['method' => 'POST', 'url' => route('customer.payment.pay', $rent->id), 'files' => true]) }}
                                <?php $total_price = 0;
                                $diskon = 0; ?>
                                @foreach ($rent->RentDetail as $detail)
                                    <tr>
                                        <td class="product-col">
                                            <h3 class="product-title">
                                                {{ $detail->OpeningHourDetail->field->name }} -
                                                {{ $detail->OpeningHourDetail->field->Venue->name }}
                                            </h3><!-- End .product-title -->
                                        </td>
                                        <td class="price-col">{{ $detail->OpeningHourDetail->OpeningHour->Hour->hour }}</td>
                                        <td class="price-col">{{ Helper::rupiah($detail->OpeningHourDetail->price) }}</td>
                                    </tr>
                                    <input type="hidden" value="{{ $detail->OpeningHourDetail->id }}" name="details[]">
                                    <input type="hidden" value="{{ $rent->started_at }}" name="date">
                                    <?php
                                    $total_price = $total_price + $detail->OpeningHourDetail->price;
                                    ?>
                                @endforeach
                            </tbody>
                        </table><!-- End .table table-wishlist -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-5">
                        <div class="summary summary-cart">
                            <h5 class="summary-title" id="remaining" style="color:red;text-align:center">
                                Waktu yang tersisa untuk melakukan pembayaran
                            </h5>
                            <br>
                            <h3 class="summary-title">Detail</h3><!-- End .summary-title -->
                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-shipping-row">
                                        <td>Nama :</td>
                                        <td>{{ Auth::user()->first_name }}
                                            {{ Auth::user()->last_name }}
                                        </td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>Tanggal :</td>
                                        <td>{{ date('d M Y', strtotime($rent->created_at)) }}</td>
                                    </tr>
                                    @if ($membership && $membership->membership_status === 1)
                                        @php
                                            $diskon_membership =
                                                ($total_price * $membership->venue->membership_discount) / 100;
                                        @endphp
                                        <tr>
                                            <td>Diskon Membership ({{ $membership->venue->membership_discount }}%) :</td>
                                            <td>{{ Helper::rupiah($diskon_membership) }}</td>
                                        </tr>
                                        <input value="{{ $diskon_membership }}" name="diskon_membership" type="hidden">
                                    @endif

                                    <tr id="point-spent-row" style="display: none;">
                                        <td>Potongan Poin :</td>
                                        <td>{{ Helper::rupiah($oneHourPrice) }}</td>
                                    </tr>

                                    <tr class="summary-shipping-row font-bold">
                                        @if (session()->has('kode'))
                                            <?php
                                            $kode = session()->get('kode')['name'];
                                            $diskon = session()->get('kode')['diskon'] * $total_price;
                                            ?>
                                            <td>Diskon ({{ $kode }}) : <br>
                                                <a href="/customer/diskon/hapus">remove</a>
                                            </td>
                                            <td>-{{ Helper::rupiah($diskon) }}</td>
                                            <input type="text" hidden value="{{ $kode }}" name="kode_promo">
                                            <input value="{{ $diskon }}" name="diskon" type="hidden">
                                        @endif
                                    </tr>
                                    <tr class="summary-shipping">
                                        <td colspan="2">Jenis Pembayaran :</td>
                                        <td></td>
                                    </tr>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="radio-lunas" name="status" value="1"
                                                    class="custom-control-input radio-dp" checked>
                                                <label class="custom-control-label" for="radio-lunas">Bayar Lunas</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php
                                    $dp_percentage = $detail->OpeningHourDetail->field->Venue->dp_percentage;
                                    $dp = ($total_price * $dp_percentage) / 100;
                                    ?>
                                    @if ($detail->OpeningHourDetail->field->Venue->dp_percentage)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">

                                                    <input type="radio" id="radio-dp" name="status" value="2"
                                                        class="custom-control-input radio-dp">
                                                    <label class="custom-control-label" for="radio-dp">Bayar DP</label>
                                                </div><!-- End .custom-control -->
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    @endif
                                    <tr class="summary-shipping-estimate" id="form-dp" style="display:none">
                                        <td><input type="text" class="form-control" name="dp" id="dp"
                                                readonly></td>
                                        <td>&nbsp;</td>
                                    </tr><!-- End .summary-shipping-estimate -->
                                    <tr class="summary-shipping">
                                        <td colspan="2">Metode Pembayaran :</td>
                                        <td></td>
                                    </tr>
                                    @foreach ($rent->Field->venue->paymentMethodDetail as $paymentMethodDetail)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio"
                                                        id="bank-{{ $paymentMethodDetail->payment_method_id }}"
                                                        name="payment_method" required
                                                        value="{{ $paymentMethodDetail->id }}"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="bank-{{ $paymentMethodDetail->payment_method_id }}">{{ $paymentMethodDetail->PaymentMethod->name }}
                                                        ({{ $paymentMethodDetail->no_rek }})
                                                    </label>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    @endforeach

                                    @if (($pointBalance?->point_balance ?? 0) >= 1000 && $hoursBooked >= 2)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        id="B-Poin"
                                                        name="point_spent"
                                                        value="1000"
                                                        class="custom-control-input">
                                                    <label id="B-Poin-label" class="custom-control-label" for="B-Poin">
                                                        B-Poin ({{ $pointBalance?->point_balance ?? 0 }} Poin)
                                                    </label>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    @endif

                                    <tr class="summary-shipping-row">
                                        <td colspan="2">Bukti Pembayaran :</td>
                                        <td></td>
                                    </tr><!-- End .summary-total -->
                                    <tr class="summary-shipping-row">
                                        <td colspan="2"><input type="file" id="payment" name="payment"
                                                accept="image/*" class="form-control"></td>
                                        <td></td>
                                    </tr><!-- End .summary-total -->

                                    <tr class="summary-total">
                                        @php
                                            $diskon_total =
                                                $diskon +
                                                ($membership && $membership->membership_status === 1
                                                    ? $diskon_membership
                                                    : 0);
                                            $total_harga_setelah_diskon = $total_price - $diskon_total;
                                        @endphp
                                        <td>Total :</td>
                                        <td id="total-harga">{{ Helper::rupiah($total_harga_setelah_diskon) }}</td>
                                        <input value="{{ $total_harga_setelah_diskon }}" name="total_price"
                                            id="input-total-price" type="hidden">
                                        <input
                                            value="{{ number_format(($total_price - ($diskon + ($membership && $membership->membership_status === 1 ? $diskon_membership : 0))) / 1000, 0, ',', '.') }}"
                                            name="point_earned" type="hidden" id="point_earned_input">
                                    </tr>
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <div id="submit">
                                <button type="submit" class="btn btn-success btn-order btn-block">Booking</button>
                            </div>
                            {!! Form::close() !!}

                            @if (session()->has('success_message'))
                                <div class="spacer mt-2"></div>
                                <div class="alert alert-success">
                                    {{ session()->get('success_message') }}
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="spacer mt-2"></div>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (!session()->has('kode'))
                                <div class="d-flex justify-content-center align-items-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary mt-4" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Makin hemat Pakai Promo
                                    </button>

                                </div>
                            @endif


                            <div style="background: #CFF4FC;" class="alert mt-2 text-center" role="alert"
                                id="point-alert">
                                <p>Selamat!! , Kamu Mendapatkan
                                    <strong>{{ number_format(($total_price - ($diskon + ($membership && $membership->membership_status === 1 ? $diskon_membership : 0))) / 1000, 0, ',', '.') }}
                                        poin</strong> jika
                                    menyelesaikan transaksi ini
                                </p>
                            </div>

                            <!-- Modal -->
                            <form action="{{ route('customer.promo.check') }}" method="POST">
                                @csrf
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pakai Promo</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body mb-1">
                                                @if ($promos->count() > 0)
                                                    @foreach ($promos as $promo)
                                                        <div
                                                            class="d-flex justify-content-around align-items-center mx-auto mt-2">
                                                            <p class="h6">{{ $promo->kode }}
                                                                (<span>{{ $promo->diskon * 100 }}%)
                                                                </span>
                                                            </p>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="kode" id="exampleRadios1"
                                                                    value="{{ $promo->kode }}" checked>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-center h5 mt-2">Lagi tidak ada Promo</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <tr class="summary-shipping">
                                                    <td colspan="2">
                                                        <div class="input-group">
                                                            {{-- <input type="text" class="form-control" id="promoCode"
                                                                name="kode" placeholder="Masukkan kode promo"> --}}
                                                            <input type="hidden" class="form-control" id="owner_id"
                                                                name="owner_id" placeholder="Masukkan kode promo"
                                                                value="{{ $detail->OpeningHourDetail->field->Venue->user_id }}">

                                                            <div
                                                                class="input-group-append d-flex justify-content-center align-items-center mx-auto">
                                                                @if ($promos->count() > 0)
                                                                    <button class="btn btn-success"
                                                                        type="submit">Apply</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
@endsection

@section('script')
    <script>
        var bPoinCheckbox = document.getElementById('B-Poin');
        var totalHargaSetelahDiskon = parseInt({{ $total_harga_setelah_diskon }});
        var harga_venue = parseInt({{ $oneHourPrice }});
        var inputTotalPrice = document.getElementById('input-total-price');
        var inputPointEarned = document.getElementById('point_earned_input');
        var pointAlert = document.getElementById('point-alert');
        var diskonMembership = parseInt({{ ($membership && $membership->membership_status === 1) ? $diskon_membership : 0 }});

        const bpoinLabel = document.getElementById('B-Poin-label');
        const pointSpentRow = document.getElementById('point-spent-row');
        const paymentMethodRadios = document.getElementsByName('payment_method');

        if (bPoinCheckbox) {
            bPoinCheckbox.addEventListener('change', function() {
                let originalPrice = parseInt({{ $total_price }});
                let totalSetelahDiskonAwal = originalPrice - diskonMembership; // Hitung diskon awal lagi

                if (bPoinCheckbox.checked) {
                    // Diskon 1 jam
                    totalHargaSetelahDiskon = totalSetelahDiskonAwal - harga_venue;

                    // Pastikan total tidak minus
                    if (totalHargaSetelahDiskon < 0) {
                        totalHargaSetelahDiskon = 0;
                    }

                    if (bpoinLabel) bpoinLabel.textContent = `B-Poin ({{ $pointBalance?->point_balance ?? 0 }} - 1000 Poin)`;
                    if (pointSpentRow) pointSpentRow.style.display = 'table-row';
                } else {
                    // Kembali ke total setelah diskon awal
                    totalHargaSetelahDiskon = totalSetelahDiskonAwal;
                    if (bpoinLabel) bpoinLabel.textContent = `B-Poin ({{ $pointBalance?->point_balance ?? 0 }} Poin)`;
                    if (pointSpentRow) pointSpentRow.style.display = 'none';
                }

                document.getElementById('total-harga').textContent = formatRupiah(totalHargaSetelahDiskon);
                inputTotalPrice.value = totalHargaSetelahDiskon;
                inputPointEarned.value = formatPointEarned(totalHargaSetelahDiskon);
                pointAlert.innerHTML = `
                <p>Selamat!! , Kamu Mendapatkan
                    <strong>${formatPointEarned(totalHargaSetelahDiskon)} poin</strong> jika menyelesaikan transaksi ini
                </p>`;
            });
        }

        // Fungsi untuk memformat angka menjadi format mata uang rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }

        // Fungsi untuk menghitung ulang nilai point earned
        function formatPointEarned(totalHarga) {
            var pointEarned = Math.round(totalHarga / 1000); // Bulatkan ke angka terdekat
            return pointEarned.toLocaleString('id-ID');
        }


        var radio = 1;
        $('.radio-dp').on('click', function(e) {
            if ($(this).val() == 1) {
                radio = 1;
                $('#form-dp').hide();
                $('#dp').val(0).change();
            } else {
                radio = 2;
                $('#form-dp').show();
                $('#dp').val("{{ $dp }}").change()
            }

        });

        var date = new Date('{{ $rent->created_at }}').getTime();
        var countDownDate = new Date(date);
        console.log(countDownDate); //penentuan selama 10 menit
        countDownDate = new Date(countDownDate.getFullYear(), countDownDate.getMonth(), countDownDate.getDate(),
            countDownDate.getHours(), countDownDate.getMinutes() + 20, countDownDate.getSeconds());
        countDownDate.setDate(countDownDate.getDate());
        // Hitungan Mundur Waktu Dilakukan Setiap Satu Detik
        var x = setInterval(function() {
            // Mendapatkan Tanggal dan waktu Pada Hari ini
            var now = new Date().getTime();
            //Jarak Waktu Antara Hitungan Mundur
            var distance = countDownDate - now;
            // Perhitungan waktu hari, jam, menit dan detik
            //perhitungan komputer diubah ke time (hari, jam , menit, detik)
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Tampilkan hasilnya di elemen id = "carasingkat"
            document.getElementById("remaining").innerHTML = "Waktu yang tersisa untuk melakukan pembayaran " +
                hours + "h " +
                minutes + "m " + seconds + "s ";
            // Jika hitungan mundur selesai,
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("remaining").innerHTML = "EXPIRED";
                $('#submit').remove();
            }
        }, 1000);
    </script>
@endsection
