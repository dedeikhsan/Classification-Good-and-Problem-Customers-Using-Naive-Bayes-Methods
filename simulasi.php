<?php
require_once 'autoload.php';

$obj = new Bayes();

$jumBaik = $obj->sumBaik();
$jumBermasalah = $obj->sumBermasalah();
$jumData = $obj->sumData();

$a1 = $_POST['tanggungan'];
$a2 = $_POST['golongan'];
$a3 = $_POST['pinjaman'];
$a4 = $_POST['waktu'];

//Baik
$tanggungan = $obj->probTanggungan($a1, "Baik");
$golongan = $obj->probGolongan($a2, "Baik");
$pinjaman = $obj->probPinjaman($a3, "Baik");
$waktu = $obj->probWaktu($a4, "Baik");

//Bermasalah
$tanggungan2 = $obj->probTanggungan($a1, "Bermasalah");
$golongan2 = $obj->probGolongan($a2, "Bermasalah");
$pinjaman2 = $obj->probPinjaman($a3, "Bermasalah");
$waktu2 = $obj->probWaktu($a4, "Bermasalah");

//Result
$paT = $obj->hitungBaik($jumBaik, $jumData, $tanggungan, $golongan, $pinjaman, $waktu);
$paF = $obj->hitungBermasalah($jumBaik, $jumData, $tanggungan2, $golongan2, $pinjaman2, $waktu2);


/*-- Cetak Hasil --*/
//Data
$hslDataBaik = round(($jumBaik / $jumData), 4);
$hslDataBermasalah = round(($jumBermasalah / $jumData), 4);

//Tanggungan
$hslTgBaik = round(($tanggungan / $jumBaik), 4);
$hslTgBermasalah = round(($tanggungan2 / $jumBermasalah), 4);

//Golongan
$hslGlBaik = round(($golongan / $jumBaik), 4);
$hslGlBermasalah = round(($golongan2 / $jumBermasalah), 4);

//Pinjaman
$hslPjBaik = round(($pinjaman / $jumBaik), 4);
$hslPjBermasalah = round(($pinjaman2 / $jumBermasalah), 4);

//Waktu
$hslWtBaik = round(($waktu / $jumBaik), 4);
$hslWtBermasalah = round(($waktu2 / $jumBermasalah), 4);

//Hasil
$hslBaik = round($hslDataBaik * ($hslTgBaik * $hslGlBaik * $hslPjBaik * $hslWtBaik), 4);
$hslBermasalah = round($hslDataBermasalah * ($hslTgBermasalah * $hslGlBermasalah * $hslPjBermasalah * $hslWtBermasalah), 4);


echo "
<div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
  <div class='container'>
    <h1 class='display-4 tebal'>Hasil Prediksi</h1>
    <p class='lead'>Berikut ini adalah hasil prediksi berdasarkan masukan nasabah menggunakan metode naive bayes.</p>
  </div>
</div>
";

echo "
<div class='card' style='width: 25rem;'>
  <div class='card-header' style='background-color:#17a2b8;color:#fff'>
    <b>Informasi Nasabah</b>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>Tanggungan : &nbsp;&nbsp;<b>$a1</b></li>
    <li class='list-group-item'>Golongan : &nbsp;&nbsp;<b>$a2</b></li>
    <li class='list-group-item'>Pinjaman : &nbsp;&nbsp;<b>$a3</b></li>
    <li class='list-group-item'>Waktu : &nbsp;&nbsp;<b>$a4</b></li>
  </ul>
</div><br>
<hr>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th>Jumlah Baik</th>
    <th>Jumlah Bermasalah</th>
    <th>Banyak Data</th>
  </tr>
  <tr>
    <td>$jumBaik</td>
    <td>$jumBermasalah</td>
    <td>$jumData</td>
  </tr>
</table>
";

echo "<br>
<table class='table table-bordered' style='font-size:18px;text-align:center'>
  <tr style='background-color:#17a2b8;color:#fff'>
    <th></th>
    <th>Baik</th>
    <th>Bermasalah</th>
  </tr>
  <tr>
    <td>pA</td>
    <td>$jumBaik / $jumData = $hslDataBaik</td>
    <td>$jumBermasalah / $jumData = $hslDataBermasalah</td>
  </tr>
  <tr>
    <td>Tanggungan</td>
    <td>$tanggungan / $jumBaik = $hslTgBaik</td>
    <td>$tanggungan2 / $jumBermasalah = $hslTgBermasalah</td>
  </tr>
  <tr>
    <td>Golongan</td>
    <td>$golongan / $jumBaik = $hslGlBaik</td>
    <td>$golongan2 / $jumBermasalah = $hslGlBermasalah</td>
  </tr>
  <tr>
    <td>Pinjaman</td>
    <td>$pinjaman / $jumBaik = $hslPjBaik</td>
    <td>$pinjaman2 / $jumBermasalah = $hslPjBermasalah</td>
  </tr>
  <tr>
    <td>Waktu</td>
    <td>$waktu / $jumBaik = $hslWtBaik</td>
    <td>$waktu2 / $jumBermasalah = $hslWtBermasalah</td>
  </tr>
  <tr>
    <td></td>
    <td>$hslDataBaik * ($hslTgBaik * $hslGlBaik  * $hslPjBaik * $hslWtBaik) = $hslBaik</td>
    <td>$hslDataBermasalah * ($hslTgBermasalah * $hslGlBermasalah * $hslPjBermasalah * $hslWtBermasalah) = $hslBermasalah</td>
  </tr>
</table>
";

echo "<br>
  <table class='table table-bordered' style='font-size:18px;text-align:center;'>
    <tr style='background-color:#17a2b8;color:#fff'>
      <th>Presentase Baik</th>
      <th>Presentase Bermasalah</th>
    </tr>
    <tr>
      <td>$hslBaik</td>
      <td>$hslBermasalah</td>
    </tr>
  </table>
";

$result = $obj->perbandingan($paT, $paF);

if ($paT > $paF) {
  echo "<br>
  <h3 class='tebal'>PRESENTASE <span class='badge badge-success' style='padding:10px'><b>BAIK</b></span> LEBIH BESAR DARI PADA PRESENTASI BERMASALAH</h3><br>";
  echo "<h4><br>Presentase baik sebanyak : <b>" . round($result[1], 2) . " %</b> <br>Presentase bermasalah sebanyak : <b>" . round($result[2], 2) . " % </b></h4>";
} else if ($paF > $paT) {
  echo "<br>
  <h3 class='tebal'>PRESENTASE <span class='badge badge-danger' style='padding:10px'><b>BERMASALAH</b></span> LEBIH BESAR DARI PADA PRESENTASI BAIK</h3><br>";
  echo "<h4><br>Presentasi baik sebanyak : <b>" . round($result[1], 2) . " %</b> <br>Presentasi bermasalah sebanyak : <b>" . round($result[2], 2) . " % </b></h4>";
}


if ($result[0] == "BAIK" || $result[0] == "BAIK") {
  echo "
  <div class='alert alert-success mt-5' role='aler'>
    <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
    <p>Selamat ! berdasarkan hasil prediksi , anda dinyatakan <b>baik!</b></p>
    <hr>
    <p class='mb-0'>- Have a nice day -</p>
  </div>";
} else {
  echo "
  <div class='alert alert-danger mt-5' role='aler'>
  <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
  <p>Maaf, berdasarkan hasil prediksi , anda dinyatakan <b>bermasalah!</p>
  <hr>
  <p class='mb-0'>- Don't give up ! -</p>
  </div>";
}
