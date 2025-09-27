  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <strong>Copyright &copy; 2025 <a href="http://adminlte.io">Go Express</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 2.0.0-rc.1
      </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
      $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 rtl -->
  <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('assets/admin/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
  </script>
  <!-- Summernote -->
  <script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('assets/admin/dist/js/pages/dashboard.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>

  <script>
      window.addEventListener('createModalToggle', event => {
          $('#createModal').modal('toggle');

      })

      window.addEventListener('updateModalToggle', event => {
          $('#updateModal').modal('toggle');
      })

      window.addEventListener('deleteModalToggle', event => {
          $('#deleteModal').modal('toggle');
      })

      window.addEventListener('showModalToggle', event => {
          $('#showModal').modal('toggle');
      })

      window.addEventListener('aproveModalToggle', event => {
          $('#aproveModal').modal('toggle');
      })

      window.addEventListener('restoreModalToggle', event => {
          $('#restoreModal').modal('toggle');
      })

        Livewire.on('printWindow', () => {
        window.print();
    });

    
    // window.addEventListener('afterprint', () => {
    //     location.reload();
    // });

      //  window.location.href = '/treasuries/' + data.id;

      // Livewire.on('changeStatus', data => {
      //     console.log('Received changeStatus event:', data);
      // });
  </script>


  @yield('js')
  </body>

  </html>
