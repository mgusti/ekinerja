      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="http://simrskita.com/developer" target="_blank">Aziz SIMRS v1.5 2021</a></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Anda Yakin untuk Keluar ?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <script src="<?= base_url('assets/'); ?>vendor/datepicker/js/bootstrap-datepicker.js"></script>



      <!-- DATATABLE -->

      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

      <!-- DATATABLE -->


      <!-- Core plugin JavaScript-->
      <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>


      <!-- Custom scripts for all pages-->
      <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

      <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js" integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI=" crossorigin="anonymous"></script>


      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/js/mdb.min.js"></script>
      <script type="text/javascript" src="<?= base_url('assets/js/edit.js') ?>"></script>
      <script type="text/javascript" src="<?= base_url('assets/vendor/sweet/dist/sweetalert2.all.min.js') ?>"></script>
      <script type="text/javascript" src="<?= base_url('assets/js/tempsweet.js') ?>"></script>

      <script>
        $(document).ready(function() {
          $(".preloader").fadeOut();
          $(".ex").dataTable();
        })
      </script>
      <script>
        $('.form-check-input').on('click', function() {

          const menuId = $(this).data('menu');
          const roleId = $(this).data('role');

          $.ajax({

            url: "<?= base_url('admin/changeAccess'); ?>",
            type: 'post',
            data: {
              menuId: menuId,
              roleId: roleId
            },
            success: function() {
              document.location.href = "<?= base_url('admin/roleAccess/'); ?>" + roleId;
            }
          });

        });
      </script>

      <script>
        $('.custom-file-input').on('change', function() {
          let fileName = $(this).val().split('//').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
        })
      </script>

      <script>
        $('.foto').on('click', function(e) {
          e.preventDefault();
          const foto = $('.foto').data('gambar');
          console.log(foto);
        })
      </script>

      <script>
        function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;

          document.body.innerHTML = printContents;

          window.print();

          document.body.innerHTML = originalContents;
        }
      </script>

      <script>
        $(document).ready(function() {
          $('#bidang').change(function() {
            var bidang = $(this).val();


            $.ajax({
              type: 'post',
              url: "<?= base_url('admin/carisub'); ?>",
              data: "bidang=" + bidang,
              success: function(response) {
                $('#subbidang').html(response);

              }
            });

          })
        });
      </script>

      <script>
        $(document).ready(function() {
          $('#ktp_prov').change(function() {
            var ktp_prov = $(this).val();


            $.ajax({
              type: 'post',
              url: "<?= base_url('user/carikota'); ?>",
              data: "ktp_prov=" + ktp_prov,
              success: function(response) {
                $('#ktp_kota').html(response);

              }
            });

          })
        });
      </script>

      <script>
        $(document).ready(function() {
          $('#ktp_kota').change(function() {
            var ktp_kota = $(this).val();


            $.ajax({
              type: 'post',
              url: "<?= base_url('user/carikec'); ?>",
              data: "ktp_kota=" + ktp_kota,
              success: function(response) {
                $('#ktp_kec').html(response);

              }
            });

          })
        });
      </script>


      <script>
        $(document).ready(function() {
          $('#ktp_kec').change(function() {
            var ktp_kec = $(this).val();


            $.ajax({
              type: 'post',
              url: "<?= base_url('user/carikel'); ?>",
              data: "ktp_kec=" + ktp_kec,
              success: function(response) {
                $('#ktp_kel').html(response);

              }
            });

          })
        });
      </script>

      <script>
        $(document).ready(function() {
          $('#dom_prov').change(function() {
            var dom_prov = $(this).val();


            $.ajax({
              type: 'post',
              url: "<?= base_url('user/caridomkota'); ?>",
              data: "dom_prov=" + dom_prov,
              success: function(response) {
                $('#dom_kab').html(response);

              }
            });

          })
        });
      </script>

      <script>
        $(document).ready(function() {
          $('#dom_kab').change(function() {
            var dom_kab = $(this).val();


            $.ajax({
              type: 'post',
              url: "<?= base_url('user/caridomkec'); ?>",
              data: "dom_kab=" + dom_kab,
              success: function(response) {
                $('#dom_kec').html(response);

              }
            });

          })
        });
      </script>


      <script>
        $(document).ready(function() {
          $('#dom_kec').change(function() {
            var dom_kec = $(this).val();


            $.ajax({
              type: 'post',
              url: "<?= base_url('user/caridomkel'); ?>",
              data: "dom_kec=" + dom_kec,
              success: function(response) {
                $('#dom_kel').html(response);

              }
            });

          })
        });
      </script>



<script type="text/javascript">
        $('#tgl_mulai').change(function() {
          var a = $('#tgl_mulai').val();
          var b = $('#tgl_akhir').val();
          var tgl = new Date(a);
          var tgl2 = new Date(b);
          console.log(tgl);
          console.log(tgl2);


          var selisih = Math.abs(tgl - tgl2) / 86400000;
          $('#jumlah').val(selisih);



        })
      </script>

      <script type="text/javascript">
        $('#tgl_akhir').change(function() {
          var a = $('#tgl_mulai').val();
          var b = $('#tgl_akhir').val();
          var tgl = new Date(a);
          var tgl2 = new Date(b);
          console.log(tgl);
          console.log(tgl2);


          var selisih = Math.abs(tgl - tgl2) / 86400000;
          $('#jumlah').val(selisih);

        })
      </script>

      <script>
        var dateClass='.datechk';
$(document).ready(function ()
{
  if (document.querySelector(dateClass).type !== 'date')
  {
    var oCSS = document.createElement('link');
    oCSS.type='text/css'; oCSS.rel='stylesheet';
    oCSS.href='//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css';
    oCSS.onload=function()
    {
      var oJS = document.createElement('script');
      oJS.type='text/javascript';
      oJS.src='//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
      oJS.onload=function()
      {
        $(dateClass).datepicker();
      }
      document.body.appendChild(oJS);
    }
    document.body.appendChild(oCSS);
  }
});
      </script>







      </body>

      </html>