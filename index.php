<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="img/nbc.png" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- font awsome -->
    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="css/brands.css" />
    <link rel="stylesheet" href="css/solid.css" />

    <link rel="stylesheet" href="css/gaya.css">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">

    <title>STATKOM</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <h3>statkomku</h3>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Naive Bayes
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_simulasi.php">Data Training</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style='margin-top:100px'>
        <div class="row">
            <div class="offset-3 col-7 mt-4">
                <h3 class="tebal">Masukkan Data Nasabah Kasus Baru. </h3>
            </div>

            <div class="offset-3 col-6">
                <form method="POST" class="mt-3">

                    <div class="form-group">
                        <label for="tanggungan">Jumlah Tanggungan :</label>
                        <select name="tanggungan" id="tanggungan" class="form-control selBox" required="required">
                            <option value="" disabled selected>-- pilih Jumlah Tanggungan Anda--</option>
                            <option value="Sedikit">Sedikit</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Banyak">Banyak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="golongan">Level Golongan :</label>
                        <select name="golongan" id="golongan" class="form-control selBox" required="required">
                            <option value="" disabled selected>-- pilih Level Golongan Anda --</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pinjaman">Level Pinjaman</label>
                        <select name="pinjaman" id="pinjaman" class="form-control selBox" required="required">
                            <option value="" disabled selected>-- pilih Level Pinjaman Anda --</option>
                            <option value="Kecil">Kecil</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Besar">Besar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="waktu">Jangka Waktu :</label>
                        <select name="waktu" id="waktu" class="form-control selBox" required="required">
                            <option value="" disabled selected>-- pilih Jangka Waktu Anda --</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary mt-3" id="dor" onclick="return simulasi()" />
                    </div>

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-5 mb-5">
                <div id="hasilSIM" style="margin-bottom:30px;">

                </div>
            </div>
        </div>

    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.js"></script>
    <script src="jspopper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle').click(function() {
                $('ul').toggleClass('active');
            });
        });

        function simulasi() {
            var tanggungan = $("#tanggungan").val();
            var golongan = $("#golongan").val();
            var pinjaman = $("#pinjaman").val();
            var waktu = $("#waktu").val();

            //validasi
            var tg = document.getElementById("tanggungan");
            var gl = document.getElementById("golongan");
            var pj = document.getElementById("pinjaman");
            var wt = document.getElementById("waktu");

            if (tg.selectedIndex == 0) {
                alert("Tanggungan Tidak Boleh Kosong");
                return false;
            }

            if (gl.selectedIndex == 0) {
                alert("Golongan Tidak Boleh Kosong");
                return false;
            }

            if (pj.selectedIndex == 0) {
                alert("Pinjaman Tidak Boleh Kosong");
                return false;
            }

            if (wt.selectedIndex == 0) {
                alert("Waktu Tidak Boleh Kosong");
                return false;
            }
            //batas validasi

            $.ajax({
                url: 'simulasi.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    tanggungan: tanggungan,
                    golongan: golongan,
                    pinjaman: pinjaman,
                    waktu: waktu
                },
                success: function(data) {
                    document.getElementById("hasilSIM").innerHTML = data;
                },
            });

            return false;

        }

        $(document).ready(function() {
            $('#dor').click(function() {
                $('html, body').animate({
                    scrollTop: $("#hasilSIM").offset().top
                }, 500);
            });
        });
    </script>

</body>

</html>