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
        <?php
        $nama_bulan = date('F', mktime(0, 0, 0, $bulan, 10)); // March
        ?>
        <h3 class="text-center"> Laporan E-kinerja TKK Disetujui Atasan</h3><br>
        <h5 class="text-center">Bulan : <?= $nama_bulan ?> / <?= $tahun ?></h5>


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
                    <th>Jumlah tkk</th>
                    <th>:</th>
                    <th><?= $tkk ?></th>
                </tr>
                <tr>
                    <th>Kinerja disetujui</th>
                    <th>:</th>
                    <th><?= $jmlacc ?></th>
                </tr>
                <tr>
                    <th>Kinerja belum disetujui</th>
                    <th>:</th>

                    <th><?= $jmltkk ?></th>
                </tr>
                <?php

                ?>


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
                    <tr class="text-uppercase">
                        <th>No.</th>
                        <th>No. Kontrak</th>
                        <th>Nik</th>
                        <th>nama</th>
                        <th>Ruangan</th>
                        <th>Respon</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $st = 1;
                    foreach ($jmlresponse as $k) :
                        $string = $k['niks'];
                        $arr_split = str_split($string);
                        $jum_str = strlen($string); //bisa juga dengan count($arr_split)

                        $replace_with = '*';
                        $replace_start = $jum_str - 5;

                        if ($replace_start < 0) {
                            return $string;
                        }

                        $str_fmt = '';
                        for ($i = 0; $i < $jum_str; $i++) {
                            if ($i < $replace_start) {
                                $str_fmt .= $arr_split[$i];
                            } else {
                                $str_fmt .= $replace_with;
                            }
                        }
                    ?>
                        <tr>
                            <td><?= $st++ ?></td>
                            <td><?= $k['nomor_kontrak'] ?></td>
                            <td><?= $str_fmt ?></td>
                            <td><?= $k['namas'] ?></td>
                            <td><?= $k['nmr'] ?></td>
                            <td class="text-center"><?= $k['jml'] ?></td>
                            

                        </tr>
                </tbody>
            <?php
                    endforeach;
            ?>
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