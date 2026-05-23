<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Laporan KIR</title>
  </head>
  <body>
  <div class="container">
    <h1 class="text-center mt-3">KARTU INVENTARIS RUANGAN</h1>

    <P>RUANGAN : <?= $ruang['nmruang']?></P>
    <P>Bulan : <?= date('F')?></P>

        <table class="table table-striped table-bordered" id="example">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Thn Anggaran</th>
                    <th scope="col">Jenis Anggaran</th>
                    <th scope="col">Nilai Satuan Barang</th>
                    <th scope="col">Baik</th>
                    <th scope="col">Kurang Baik</th>
                    <th scope="col">Rusak</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Total Nilai Barang</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                    foreach($barang as $b):
                        $total = $b['nilai_barang'] * $b['toba'];
                ?>
                <tr>
                    <th scope="row"><?= $i++;?></th>
                    <td><?= $b['kdbarang']?></td>
                    <td><?= $b['nama']?></td>
                    <td><?= $b['jenisbarang']?></td>
                    <td><?= $b['thn_anggaran']?></td>
                    <td><?= $b['jenis_anggaran']?></td>
                    <td>Rp. <?= number_format($b['nilai_barang'],2,',','.')?></td>
                    <td class="text-primary"><?= $b['baik']?></td>
                    <td class="text-warning"><?= $b['sedang']?></td>
                    <td class="text-danger"><?= $b['rusak']?></td>
                    <td><?= $b['toba']?></td>
                    <td>Rp. <?= number_format($total,2,',','.')?></td>
                </tr>
                
                <?php
                    endforeach;
                ?>
                <tr>
                        <th colspan="7">Total Keseluruhan</th>
                       
                        
                        <th><?= $total1['baik1']?></th>
                        <th><?= $total1['kurang1']?></th>
                        <th><?= $total1['rusak1']?></th>
                        <th><?= $total1['totkd']?></th>
                        <th>Rp.<?=  number_format($total1['nilai'],2,',','.')?></th>
                </tr>
            </tbody>
        </table>
        <div class="row text-center">
            
                <table class="table-lg mx-auto" border="0" cellpadding="5" >
                    <tr>
                        <td>Mengetahui</td>
                        <td></td>
                        <td>Diketahui</td>
                        <td></td>
                        <td>Jambi, <?= date('d-F-Y')?></td>
                        
                    </tr>
                    <tr>
                        <td>Direktur RSUD H. Abdul Manap</td>
                        <td></td>
                        <td>Penanggung Jawab Ruangan</td>
                        <td></td>
                        <td>Pengurus Barang</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>RUDI</td>
                        <td></td>
                        <td>budi</td>
                        <td></td>
                        <td>SINTA MARLINDA, SE</td>
                    </tr>
                    <tr>
                        <td>NIP :123123122</td>
                        <td></td>
                        <td>NIP: 123123</td>
                        <td></td>
                        <td>NIP. 19820406 200701 2 004</td>
                    </tr>
                </table>      
            
        </div>
        <style>
            #catat{
                font-size:12px;
            }
        </style>
        <div class="row mt-3" id="catat">
            <p>NB:</p>
            <ul class="text-danger">
                <li>Dilarang memindahkan barang tanpa sepengetahuan Pengurus Barang  / Kepala Ruangan</li>
                <li>Kepala Ruang bertanggung jawab terhadap barang yang ada diruang</li>
                <li>Apabila ada yang rusak atau tidak bisa dipakai harap melaporkan kepada Pengurus Barang/IPSRS</li>
                <li>Mohon kerja sama yang baik</li>
            </ul>
        </div>
  </div>
  
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>