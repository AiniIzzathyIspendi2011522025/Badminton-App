<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Booking Lapangan Futsal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                size: landscape
            }
        }

        @page {
            size: A4 landscape;
        }


        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            font-weight: bold;
            text-align: center;
            color: rgb(3, 10, 103);
            background-color: rgb(255, 252, 252);
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
            text-align: center;
            background-color: white;
        }

        .text-center {
            text-align: center;
        }
    </style>
    <style type="text/css" media="print">
        .page {
            -webkit-transform: rotate(-90deg);
            -moz-transform: rotate(-90deg);
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        }
    </style>
</head>

<body>
    <section class="sheet padding-10mm">
        <div class="row">
            <div class="col-12">
            </div>
            <div class="col-12">
                <center>
                    <h4><b>Laporan Transaksi Booking Lapangan Futsal</b></h4>
                </center>
            </div>
        </div>
        <br>
        <hr>
        @foreach ($venues as $venue)
        <div class="row">
            <div class="col-12">
                <p><strong>Nama Venue : {{$venue->name}}</strong></p>
                <p><strong>Transaksi pada : {{$date[0]}} - {{$date[1]}}</strong></p>
            </div>
        </div>
        <?php 
                    $fields = App\Models\Field::where('venue_id', $venue->id)->get();
                    $field_id = collect([]);
                    foreach($fields as $field){
                        $field_id->push($field->id);
                    }
                    $rents = App\Models\Rent::whereIn('field_id', $field_id)
                                            ->where(DB::raw('date_format(created_at, "%m/%d/%Y")'), '>=', $date[0])
                                            ->where(DB::raw('date_format(created_at, "%m/%d/%Y")'), '<=', $date[1])
                                            ->where('status', 4)
                                            ->get();
                ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal booking</th>
                    <th>Penyewa</th>
                    <th>Lapangan</th>
                    <th>Jam mulai - berakhir</th>
                    <th>Durasi booking</th>
                    <th>Metode booking</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($rents as $rent)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$rent->created_at->format('d/m/Y')}}</td>
                    <td>{{$rent->tenant_name}}</td>
                    <td>{{$rent->Field->name}}</td>
                    <td>{{$rent->order('asc')}} - {{$rent->order('desc')}}</td>
                    <td>{{$rent->RentDetail->count()}} jam</td>
                    <td>
                        @if ($rent->RentPayment)
                        Online
                        @else
                        Offline
                        @endif
                    </td>
                    <td>{{Helper::rupiah($rent->total_price)}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="7">Total Pemasukan</th>
                    <th>{{Helper::rupiah($rents->sum('total_price'))}}</th>
                </tr>
            </tbody>
        </table>
        @endforeach

        <hr>
    </section>
</body>

</html>