<?php
require_once 'autoload.php';

$obj = new Bayes();

$jumBaik = $obj->sumBaik();
$jumBermasalah = $obj->sumBermasalah();
$jumData = $obj->sumData();

$a1 = "Banyak";
$a2 = "III";
$a3 = "Besar";
$a4 = "3";

//TRUE
$tanggungan = $obj->probTanggungan($a1, "Baik");
$golongan = $obj->probGolongan($a2, "Baik");
$pinjaman = $obj->probPinjaman($a3, "Baik");
$waktu = $obj->probWaktu($a4, "Baik");

//FALSE
$tanggungan2 = $obj->probTanggungan($a1, "Bermasalah");
$golongan2 = $obj->probGolongan($a2, "Bermasalah");
$pinjaman2 = $obj->probPinjaman($a3, "Bermasalah");
$waktu2 = $obj->probWaktu($a4, "Bermasalah");

//result
$paT = $obj->hitungBaik($jumBaik, $jumData, $tanggungan, $golongan, $pinjaman, $waktu);
$paF = $obj->hitungBermasalah($jumBaik, $jumData, $tanggungan2, $golongan2, $pinjaman2, $waktu2);

echo "
======================================<br>
tanggungan : $a1<br>
golongan : $a2<br>
pinjaman : $a3<br>
waktu : $a4<br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan baik : <br>
jumlah baik : $jumBaik <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan bermasalah : <br>
jumlah bermasalah : $jumBermasalah <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
pABaik : $jumBaik / $jumData<br>
tanggungan baik : $tanggungan / $jumBaik <br>
golongan baik : $golongan / $jumBaik <br>
pinjaman baik : $pinjaman / $jumBaik <br>
waktu baik : $waktu / $jumBaik <br>
=======================================<br><br>
";

echo "
======================================<br>
pABermasalah : $jumBermasalah / $jumData<br>
tanggungan bermasalah : $tanggungan2 / $jumBermasalah <br>
golongan bermasalah : $golongan2 / $jumBermasalah <br>
pinjaman bermasalah : $pinjaman2 / $jumBermasalah <br>
waktu bermasalah : $waktu2 / $jumBermasalah <br>
=======================================<br><br>
";

echo "
======================================<br>
presentasi Baik : $paT<br>
presentasi Bermasalah : $paF<br>
=======================================<br><br>
";

if ($paT > $paF) {
  echo "
  ======================================<br>
  PRESENTASI BAIK LEBIH BESAR DARI PADA PRESENTASI BERMASALAH<br>
  =======================================
  <br><br>";
} else if ($paF > $paT) {
  echo "
  ======================================<br>
  PRESENTASI BERMASALAH LEBIH BESAR DARI PADA PRESENTASI BAIK<br>
  =======================================
  <br><br>";
}

$result = $obj->perbandingan($paT, $paF);
echo " Status : $result[0] <br>Presentasi baik sebanyak : " . round($result[1], 2) . " % <br>Presentasi bermasalah sebanyak : " . round($result[2], 2) . " % ";
