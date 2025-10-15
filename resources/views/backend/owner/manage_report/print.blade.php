<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Laporan Transaksi Booking Lapangan Badminton</title>

  <!-- Opsional: Paper CSS (boleh dipertahankan jika sudah dipakai) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Opsional: Bootstrap grid (tidak wajib untuk PDF) -->
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

  <style>
    /* Kertas A4 landscape saat print/PDF */
    @page { size: A4 landscape; margin: 10mm; }

    /* ====== Letterhead / Kop Surat ====== */
    .letterhead {
      display: grid;
      grid-template-columns: 1fr 280px;
      gap: 16px;
      align-items: center;
      border-bottom: 3px solid #0ea5e9;
      padding-bottom: 12px;
      margin-bottom: 16px;
      font-family: "Segoe UI", Arial, sans-serif;
      color: #0f172a;
    }
    .company h1 {
      margin: 0; font-size: 20px; font-weight: 800; letter-spacing: .2px; text-align: center;
    }
    .company p {
      margin: 2px 0; font-size: 12px; color: #475569; text-align: center;
    }
    .doc-title {
      margin-top: 8px; font-size: 14px; font-weight: 800; color: #0f172a;
    }
    .doc-meta {
      border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 12px;
      background: #f8fafc; font-size: 12px; color: #334155;
    }
    .doc-meta .label { color: #64748b; margin-right: 6px; }

    /* ====== Tabel Modern ====== */
    .table-modern {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      font-size: 12.5px;
      color: #0f172a;
      page-break-inside: avoid; /* kurangi kemungkinan terbelah */
    }
    .table-modern thead th {
      background: #eef2f7;
      color: #0f172a;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: .3px;
      border-bottom: 2px solid #e2e8f0;
      padding: 9px 8px;
      text-align: center;
    }
    .table-modern tbody td {
      background: #fff;
      border-bottom: 1px solid #eef2f7;
      padding: 7px 8px;
      text-align: center;
    }
    .table-modern tbody tr:nth-child(odd) td { background: #fcfdff; }
    .table-modern tfoot th {
      background: #f1f5f9;
      border-top: 2px solid #e2e8f0;
      padding: 9px 8px;
      text-align: right;
      font-weight: 800;
    }
    .w-xxs { width: 52px; }
    .ta-r  { text-align: right; }
    .ta-c  { text-align: center; }
    .nowrap { white-space: nowrap; }

    /* ====== Page break per venue ====== */
    .venue-page {
      page-break-after: always;   /* paksa halaman baru setelah venue */
    }
    .venue-page:last-of-type {
      page-break-after: auto;     /* hapus break di venue terakhir */
    }

    /* Padding halaman: gunakan jika tidak pakai .sheet dari paper-css */
    .page-padding {
      padding: 10mm;
    }
  </style>
</head>
<body>

  @foreach ($venues as $venue)
    <section class="venue-page page-padding">
      <!-- KOP SURAT per-venue -->
      <header class="letterhead">
        <div class="company">
          <h1>{{ $venue->name }}</h1>
          <p>{{ $venue->address }}</p>
          <div class="doc-title">Laporan Transaksi Booking Lapangan Badminton</div>
        </div>
        <div class="doc-meta">
          <div><span class="label">Dokumen:</span><strong>Laporan Transaksi Booking</strong></div>
          <div><span class="label">Tanggal Cetak:</span>{{ now()->format('d/m/Y H:i') }}</div>
          <div>
            <span class="label">Periode:</span>
            @if (!empty($date_range))
              {{ $date_range }}
            @elseif (!empty($date) && isset($date[0], $date[1]))
              {{ $date[0] }} — {{ $date[1] }}
            @else
              -
            @endif
          </div>
        </div>
      </header>

      {{-- Query sesuai kode kamu (idealnya pindah ke controller, tapi kita biarkan) --}}
      <?php
        $fields = App\Models\Field::where('venue_id', $venue->id)->get();
        $field_id = collect([]);
        foreach($fields as $field){ $field_id->push($field->id); }
        $rents = App\Models\Rent::whereIn('field_id', $field_id)
                  ->where(DB::raw('date_format(created_at, "%m/%d/%Y")'), '>=', $date[0])
                  ->where(DB::raw('date_format(created_at, "%m/%d/%Y")'), '<=', $date[1])
                  ->where('status', 4)
                  ->get();
      ?>

      <!-- Tabel modern per-venue -->
      <table class="table-modern">
        <thead>
          <tr>
            <th class="w-xxs ta-c">No</th>
            <th class="ta-c">Tanggal Booking</th>
            <th class="ta-c">Penyewa</th>
            <th class="ta-c">Lapangan</th>
            <th class="ta-c nowrap">Jam Mulai - Berakhir</th>
            <th class="ta-c">Durasi Booking</th>
            <th class="ta-c">Metode Booking</th>
            <th class="ta-r">Total</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($rents as $rent)
            <tr>
              <td class="ta-c">{{ $loop->iteration }}</td>
              <td class="ta-c">{{ $rent->created_at->format('d/m/Y') }}</td>
              <td class="ta-c">{{ $rent->tenant_name }}</td>
              <td class="ta-c">{{ $rent->Field->name }}</td>
              <td class="ta-c nowrap">{{ $rent->order('asc') }} - {{ $rent->order('desc') }}</td>
              <td class="ta-c">{{ $rent->RentDetail->count() }} jam</td>
              <td class="ta-c">{{ $rent->RentPayment ? 'Online' : 'Offline' }}</td>
              <td class="ta-r">{{ Helper::rupiah($rent->total_price) }}</td>
            </tr>
          @endforeach
        </tbody>

        <tfoot>
          <tr>
            <th colspan="7" class="ta-r">Total Pemasukan</th>
            <th class="ta-r">{{ Helper::rupiah($rents->sum('total_price')) }}</th>
          </tr>
        </tfoot>
      </table>
    </section>
  @endforeach

</body>
</html>
