<?php

class Bayes
{
    //property hak akses private
    private $nasabah = "data_training.json";

    function __construct()
    {
    }

    //fungsi menghitung jumlah clas "baik"
    public function sumBaik()
    {
        $data = file_get_contents($this->nasabah);
        $hasil = json_decode($data, true);

        $i = 0;
        foreach ($hasil as $hasil) {
            if ($hasil['class'] == "Baik") {
                $i = $i + 1;
            }
        }

        return $i;
    }

    //fungsi menghitung jumlah class "bermasalah"
    public function sumBermasalah()
    {
        $data = file_get_contents($this->nasabah);
        $hasil = json_decode($data, true);

        $i = 0;
        foreach ($hasil as $hasil) {
            if ($hasil['class'] == "Bermasalah") {
                $i = $i + 1;
            }
        }

        return $i;
    }

    //Fungsi menghitung banyak data
    public function sumData()
    {
        $data = file_get_contents($this->nasabah);
        $hasil = json_decode($data, true);
        return count($hasil);
    }



    /*===========================================
            Function Probabilitas Nasabah
    ============================================*/
    public function probTanggungan($tanggungan, $class)
    {
        $data = file_get_contents($this->nasabah);
        $hasil = json_decode($data, true);

        $i = 0;
        foreach ($hasil as $hasil) {
            if ($hasil['tanggungan'] == $tanggungan && $hasil['class'] == $class) {
                $i += 1;
            } else if ($hasil['tanggungan'] == $tanggungan && $hasil['class'] == $class) {
                $i += 1;
            }
        }

        return $i;
    }

    public function probGolongan($golongan, $class)
    {
        $data = file_get_contents($this->nasabah);
        $hasil = json_decode($data, true);

        $i = 0;
        foreach ($hasil as $hasil) {
            if ($hasil['golongan'] == $golongan && $hasil['class'] == $class) {
                $i += 1;
            } else if ($hasil['golongan'] == $golongan && $hasil['class'] == $class) {
                $i += 1;
            }
        }

        return $i;
    }

    public function probPinjaman($pinjaman, $class)
    {
        $data = file_get_contents($this->nasabah);
        $hasil = json_decode($data, true);

        $i = 0;
        foreach ($hasil as $hasil) {
            if ($hasil['pinjaman'] == $pinjaman && $hasil['class'] == $class) {
                $i += 1;
            } else if ($hasil['pinjaman'] == $pinjaman && $hasil['class'] == $class) {
                $i += 1;
            }
        }

        return $i;
    }

    public function probWaktu($waktu, $class)
    {
        $data = file_get_contents($this->nasabah);
        $hasil = json_decode($data, true);

        $i = 0;
        foreach ($hasil as $hasil) {
            if ($hasil['waktu'] == $waktu && $hasil['class'] == $class) {
                $i += 1;
            } else if ($hasil['waktu'] == $waktu && $hasil['class'] == $class) {
                $i += 1;
            }
        }

        return $i;
    }



    /*=============================================================== 
                        Perhitungan Naive Bayes
    $jT     = Jumlah data bernilai true / baik (sumBaik)
    $jF     = Jumlah data bernilai false / bermasalah (sumBermasalah)
    $jD     = Banyak data pada data training (sumData)
    $pTg    = Jumlah probabilitas tanggungan (probTanggungan)
    $pGl    = Jumlah probabilitas golongan (porbGolongan)
    $pPl    = Jumlah porbabilitas pinjaman (probPinjaman)
    $pWt    = Jumlah probabilitas waktu (probWaktu)
    =================================================================*/

    public function hitungBaik($jT = 0, $jD = 0, $pTg = 0, $pGl = 0, $pPj = 0, $pWt = 0)
    {
        $pTrue = $jT / $jD;
        $p1 = $pTg / $jT;
        $p2 = $pGl / $jT;
        $p3 = $pPj / $jT;
        $p4 = $pWt / $jT;
        $hsl = $pTrue * $p1 * $p2 * $p3 * $p4;

        return $hsl;
    }

    public function hitungBermasalah($jF = 0, $jD = 0, $pTg = 0, $pGl = 0, $pPj = 0, $pWt = 0)
    {
        $pFalse = $jF / $jD;
        $p1 = $pTg / $jF;
        $p2 = $pGl / $jF;
        $p3 = $pPj / $jF;
        $p4 = $pWt / $jF;
        $hsl = $pFalse * $p1 * $p2 * $p3 * $p4;

        return $hsl;
    }

    public function perbandingan($pTrue, $pFalse)
    {
        if ($pTrue > $pFalse) {
            $stt = "BAIK";
            $hitung = ($pTrue / ($pTrue + $pFalse)) * 100;
            $diterima = 100 - $hitung;
        } else if ($pFalse > $pTrue) {
            $stt = "BERMASALAH";
            $hitung = ($pTrue / ($pFalse + $pTrue)) * 100;
            $diterima = 100 - $hitung;
        } else {
            $stt = "BAIK";
            $hitung = 0;
            $diterima = 0;
        }

        $hsl = array($stt, $hitung, $diterima);
        return $hsl;
    }
}
