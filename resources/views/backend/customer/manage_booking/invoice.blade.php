<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Invoice</title>
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />
    <style>
        body { font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; text-align:center; color:#777; }
        body h1 { font-weight:300; margin-bottom:0; padding-bottom:0; color:#000; }
        body h3 { font-weight:300; margin:10px 0 20px; font-style:italic; color:#555; }
        body a { color:#06f; }
        .invoice-box { max-width:800px; margin:auto; padding:30px; border:1px solid #eee; box-shadow:0 0 10px rgba(0,0,0,.15); font-size:16px; line-height:24px; color:#555; }
        .invoice-box table { width:100%; line-height:inherit; text-align:left; border-collapse:collapse; }
        .invoice-box table td { padding:5px; vertical-align:top; }
        .invoice-box table tr td:nth-child(2) { text-align:right; }
        .invoice-box table tr.top table td { padding-bottom:20px; }
        .invoice-box table tr.top table td.title { font-size:45px; line-height:45px; color:#333; }
        .invoice-box table tr.information table td { padding-bottom:40px; }
        .invoice-box table tr.heading td { background:#eee; border-bottom:1px solid #ddd; font-weight:bold; }
        .invoice-box table tr.details td { padding-bottom:20px; }
        .invoice-box table tr.item td { border-bottom:1px solid #eee; }
        .invoice-box table tr.item.last td { border-bottom:none; }
        .invoice-box table tr.total td:nth-child(2) { border-top:2px solid #eee; font-weight:bold; }
        @media only screen and (max-width: 600px){
            .invoice-box table tr.top table td,
            .invoice-box table tr.information table td { width:100%; display:block; text-align:center; }
        }
    </style>
</head>
<body>
    <h1>{{ $rents->field->venue->name }}</h1>
    <br>

    @php
        // Null-safe akses relasi dan angka
        $paymentMethodName = $rents->rentPayment?->paymentMethodDetail?->paymentMethod?->name ?? '-';
        if($rents->rentPayment?->note === 'B-Poin') {
            $diskonPoin = (int)($rents->RentDetail->first()->OpeningHourDetail->price ?? 0);
        } else {
            $diskonPoin = 0;
        }
        $subtotal = (int)($rents->total_price ?? 0) + (int)($rents->diskon ?? 0) + (int)($rents->diskon_membership ?? 0) + $diskonPoin;

        // Total akhir
        $totalAkhir = (int)($rents->total_price ?? 0);
    @endphp

    <div class="invoice-box">
        <table>
            {{-- Header / QR --}}
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                Invoice #: {{ $rents->id }}<br>
                                Created:
                                @if($rents->created_at instanceof \Illuminate\Support\Carbon || $rents->created_at instanceof \Carbon\Carbon)
                                    {{ $rents->created_at->format('d/m/Y H:i') }}
                                @else
                                    {{ $rents->created_at }}
                                @endif
                                <br>
                            </td>
                            <td style="text-align:right;">
                                {{-- QR harus berada di dalam <td> --}}
                                {!! $qrcode !!}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            {{-- Informasi lokasi --}}
            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>{{ $rents->field->venue->address }}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            {{-- Metode Pembayaran --}}
            <tr class="heading">
                <td colspan="6">Payment Method</td>
            </tr>
            <tr class="details">
                <td colspan="6">{{ $paymentMethodName }}</td>
            </tr>

            {{-- Daftar Item Sewa --}}
            <tr class="heading">
                <td>Lapangan</td>
                <td>Tanggal</td>
                <td></td>
                <td>Waktu</td>
                <td></td>
                <td>Harga</td>
            </tr>

            @foreach ($rents->RentDetail as $rentDetail)
                <tr class="item @if($loop->last) last @endif">
                    <td>{{ $rentDetail->rent->Field->name ?? '-' }}</td>
                    <td>{{ $rentDetail->rent->date ?? '-' }}</td>
                    <td></td>
                    <td>{{ $rentDetail->OpeningHourDetail?->OpeningHour?->Hour?->hour ?? '-' }}</td>
                    <td></td>
                    <td>{{ Helper::rupiah($rentDetail->OpeningHourDetail->price ?? 0) }}</td>
                </tr>
            @endforeach

            {{-- Ringkasan --}}
            <tr class="total">
                <td colspan="5" style="text-align:right;">Subtotal:</td>
                <td>{{ Helper::rupiah($subtotal) }}</td>
            </tr>

            @if(($rents->diskon ?? 0) > 0)
            <tr>
                <td colspan="4" style="text-align:right;">
                    Diskon ({{ $rents->kode_promo ?? '-' }}):
                </td>
                <td colspan="5">- {{ Helper::rupiah($rents->diskon ?? 0) }}</td>
            </tr>
            @endif

            @if(($rents->diskon_membership ?? 0) > 0)
            <tr>
                <td colspan="4" style="text-align:right;">Diskon Membership:</td>
                <td colspan="5"> - {{ Helper::rupiah($rents->diskon_membership ?? 0) }}</td>
            </tr>
            @endif

            {{-- TAMPILKAN DISKON POIN HANYA JIKA NOTE === "B-Poin" --}}
            @if($rents->rentPayment?->note === 'B-Poin' && $diskonPoin > 0)
            <tr>
                <td colspan="4" style="text-align:right;">Diskon Poin:</td>
                <td colspan="5">- {{ Helper::rupiah($diskonPoin) }}</td>
            </tr>
            @endif

            <tr>
                <td colspan="5" style="text-align:right;"><strong>Total:</strong></td>
                <td><strong>{{ Helper::rupiah($totalAkhir) }}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
