<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cetak</title>
</head>
<style>
    img {
        width: 80px;
    }

    hr {
        border: 3px solid;
        border-radius: 5px;
    }

    .kolom {
        float: left;
        width: 50%;
        padding: 10px;
        height: auto;
    }



    .rows:after {
        content: "";
        display: table;
        clear: both;
    }

    @media screen and (max-width: 600px) {
        .column {
            width: 100px;
        }
    }

    @media print {}
</style>



<body>
    <div class="container  mt-3 ">
        <div style="text-align: justify;" class="mt-2 mb-2 header">
            <img src="<?= base_url('assets/img/logo.png') ?>" style="float: left; margin: 5px 9px 3px 50px;" />
            <h3 class="text-center">PEMERINTAH KOTA JAMBI</h3>
            <h2 class="text-center">RSUD H. ABDUL MANAP KOTA JAMBI</h2>
            <p class="text-center">Jl. Raden Syahbudin, Mayang Mangurai, Alam Barajo, Kota Jambi, Jambi 36129</p>

            <hr class="har">
        </div>

        <h3 class="text-center"> FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h3>


        <style>
            .atas {
                width: 500px;

            }

            .atas th,
            .atas td {
                padding: 6px 2px;
            }
        </style>

        <div class="container mt-4 ml-4 ">
            <table class="atas">
                <tr>
                    <th>NIK</th>
                    <th>:</th>
                    <th><?= $cuti['nik'] ?></th>
                </tr>
                <tr>
                    <th>NIP</th>
                    <th>:</th>
                    <th><?= $cuti['nip'] ?></th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <th>:</th>
                    <th><?= $cuti['nama'] ?></th>
                </tr>


            </table>
        </div>


        <div class="container mt-4 ">
            <style>
                .isi th {
                    border: 1px solid;
                }

                .isi td {
                    border: 1px solid;
                }

                .isi thead {
                    border: 1px solid;
                }

                .isi th {
                    border: 1px solid;
                }
            </style>
            <table class="table  mt-3 isi">
                <thead class="table-active text-center">

                </thead>
                <tbody>
                    <?php
                    $awal = strtotime($cuti['tgl_mulai_ajuan']);
                    $selesai = strtotime($cuti['tgl_selesai_ajuan']);
                    ?>
                    <tr>
                        <th>Jenis Cuti</th>
                        <th>:</th>
                        <td><?= $cuti['jt'] ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Cuti</th>
                        <th>:</th>
                        <td><?= date('d/m/Y', $awal) . ' s/d ' . date('d/m/Y', $selesai) ?></td>
                    </tr>

                    <tr>
                        <th>Jumlah Hari</th>
                        <th>:</th>
                        <td><?= $cuti['jumlah_hari'] . ' Hari' ?></td>
                    </tr>
                </tbody>

            </table>
        </div>

        <div class="container mt-4">
            <div class="float-right mr-5">
                <p><strong>Jambi, <?= date('d/m/Y') ?></strong></p>
                <p class="text-center"><strong>Disetujui</strong></p>
                <p>Kasubag kepegawaian</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="text-center">Raden Abdul Latif</p>
                <p>197808232005011003</p>
            </div>
            <div class="float-right mr-5">
                <p></p><br>
                <p class="text-center"><strong>Diketahui</strong></p>
                <p>Atasan Langsung</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="text-center">Raden Abdul Latif</p>
                <p>197808232005011003</p>
            </div>

        </div>




    </div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>