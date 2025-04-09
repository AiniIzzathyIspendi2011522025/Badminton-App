<?php namespace App\Helpers;

use Sentinel;

class helper {
    public static function awalan($kalimat) {
        $katas=explode(" ", $kalimat);
        $hasil='';

        foreach($katas as $kata) {
            if(strlen($kata) !=0) {
                $hasil .=$kata[0].' ';
            }
        }

        $hasil=substr($hasil, 0, 7);
        return strtoupper($hasil);
    }

    public static function rupiah($val) {
        return "Rp. ".number_format($val, 0, ',', '.'). ",00";
    }

    public static function dateFormat($val) {
        return $val->format('d F Y');
    }

    public static function rupiahSecond($val) {
        return "Rp. ".number_format($val, 0, ',', '.');
    }

    public static function timeago($date) {
        $timestamp=strtotime($date);

        $strTime=array("detik", "menit", "jam", "hari", "bulan", "tahun");
        $length=array("60", "60", "24", "30", "12", "10");

        $currentTime=time();

        if($currentTime >=$timestamp) {
            $diff=time()- $timestamp;

            for($i=0; $diff >=$length[$i] && $i < count($length)-1; $i++) {
                $diff=$diff / $length[$i];
            }

            $diff=round($diff);
            return $diff . " ". $strTime[$i] . " yang lalu";
        }
    }

    public static function sekianwaktu($time) {
        $selisih=time() - strtotime($time);
        $detik=$selisih;
        $menit=round($selisih / 60);
        $jam=round($selisih / 3600);
        $hari=round($selisih / 86400);
        $minggu=round($selisih / 604800);
        $bulan=round($selisih / 2419200);
        $tahun=round($selisih / 29030400);

        if ($detik <=60) {
            $waktu=$detik.' '.__('helper.h_sekian_waktu.sw_detik');
        }

        else if ($menit <=60) {
            $waktu=$menit.' '.__('helper.h_sekian_waktu.sw_menit');
        }

        else if ($jam <=24) {
            $waktu=$jam.' '.__('helper.h_sekian_waktu.sw_jam');
        }

        else if ($hari <=7) {
            $waktu=$hari.' '.__('helper.h_sekian_waktu.sw_hari');
        }

        else if ($minggu <=4) {
            $waktu=$minggu.' '.__('helper.h_sekian_waktu.sw_minggu');
        }

        else if ($bulan <=2) {
            $waktu=$bulan.' '.__('helper.h_sekian_waktu.sw_bulan');
        }

        else {
            $waktu=$time;
        }

        return $waktu;
    }

}
