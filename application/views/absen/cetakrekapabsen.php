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

        <h3 class="text-center"> LAPORAN REKAP ABSEN </h3><br>



        <style>
            .atas {
                width: 500px;

            }

            .atas th,
            .atas td {
                padding: 6px 2px;
            }
        </style>




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
                <p class="text-left">Bulan : <?= $bulan['nama_bulan'] . '-' . $_GET['tahun'] ?> </p>
                <thead class="table-active text-center">
                    <?php
                    if ($_GET['role'] == 2) {
                        $aksi = "d-none";
                    } else {
                        $aksi = "d-block";
                    }
                    ?>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th class="<?= $aksi ?>">NIP</th>
                        <th>Nama</th>
                        <th>Kehadiran</th>
                        <th>Alpa</th>
                        <th>Izin</th>
                        <th>Dinas Luar</th>
                        <th>Cuti</th>
                        <th>Libur</th>
                        <th>Jumlah</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($rekap as $r) :


                    ?>
                        <tr>
                            <th><?= $i++ ?></th>
                            <td><?= $r['nik'] ?></td>
                            <td class="<?= $aksi ?>"><?= $r['nip'] ?></td>
                            <td><?= $r['nama'] ?></td>
                            <th class="text-center"><?= $r['jh'] ?></th>
                            <th class="text-center"><?= $r['ja'] ?></th>
                            <th class="text-center"><?= $r['ji'] ?></th>
                            <th class="text-center"><?= $r['jdl'] ?></th>
                            <th class="text-center"><?= $r['jdc'] ?></th>
                            <th class="text-center"><?= $r['lbr'] ?></th>
                            <th class="text-center"><?= $r['jabsen'] ?></th>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>

            </table>
        </div>






    </div>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>