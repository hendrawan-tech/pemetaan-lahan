<?php

namespace App\Helpers;

class Helper
{
    public static function price($price)
    {
        return "Rp. " . number_format($price, 0, ',', '.');
    }
    
    public static function waktu($tgl)
    {
        $qq = '';
        $k = explode(" ", $tgl);
        $kk = explode("-", $k[0]);
        $bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        $qq = $kk[2] . ' ' . $bln[(int)$kk[1]] . ' ' . $kk[0] . ' ' . $k[1];
        return $qq;
    }
}
