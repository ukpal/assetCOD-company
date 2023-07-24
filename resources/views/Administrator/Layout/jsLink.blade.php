<script src="{{URL::asset('public/Administrator/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{URL::asset('public/Administrator/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{URL::asset('public/Administrator/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{URL::asset('public/Administrator/plugins/sparklines/sparkline.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{URL::asset('public/Administrator/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{URL::asset('public/Administrator/plugins/moment/moment.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
  src="{{URL::asset('public/Administrator/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{URL::asset('public/Administrator/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script
  src="{{URL::asset('public/Administrator/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('public/Administrator/dist/js/adminlte.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/alphanum/jquery.alphanum.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{URL::asset('public/Administrator/plugins/toastr/toastr.min.js')}}"></script>

<!-- Select2 -->
<script src="{{URL::asset('public/Administrator/plugins/select2/js/select2.full.min.js')}}"></script>

<script src="{{URL::asset('public/Administrator/dist/js/pages/dashboard.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script
  src="{{URL::asset('public/Administrator/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script
  src="{{URL::asset('public/Administrator/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('public/Administrator/dist/js/MySidebar.js')}}"></script>

<script>
  $(function () {
    $('.select2bs4').select2();

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      'aoColumnDefs': [
        {
          'bSortable': false,
          'aTargets': [-1, -2, -3] /* 1st one, start by the right */
        },
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      'aoColumnDefs': [
        {
          'bSortable': false,
          'aTargets': [-1, -2, -3] /* 1st one, start by the right */
        },
      ]
    });

    $('#role_list').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      'aoColumnDefs': [
        {
          'bSortable': false,
          'aTargets': [-1, -2] /* 1st one, start by the right */
        },
      ]
    });

    $('#modules').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      'aoColumnDefs': [
        {
          'bSortable': false,
          'aTargets': [-1, -2, -3] /* 1st one, start by the right */
        },
      ]
    });

    $('#user_list').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      'aoColumnDefs': [
        {
          'bSortable': false,
          'aTargets': [-1, -2] /* 1st one, start by the right */
        },
      ]
    });
  });
</script>

<script>
  $(document).ready(function () {

    if (localStorage.getItem('company_logo')) {
      $('#brand-image').attr("src", "{{url('')}}"+"/public/Administrator/images/logo/" + localStorage.getItem('company_logo'));
      $('#brand-image').removeClass('d-none');
    } else {
      $('#default-brand-image').removeClass('d-none');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{route('get-general-setting')}}",
        success: function (data) {
          if(data){
              localStorage.setItem('company_logo', data)
              $('.brand-image').attr("src", "{{url('')}}"+"/public/Administrator/images/logo/" + localStorage.getItem('company_logo'));
          }else{
              $('#default-brand-image').removeClass('d-none');
          }

        },
        error: function (data) {
        }
      });
    }

  })
</script>

<script>

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.dltBtn').click(function (e) {
    var form = $(this).closest('form');
    var dataID = $(this).data('id');
    e.preventDefault();

    swal({
      title: "Are you sure?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        form.submit();
        swal("User has been deleted!", {
          icon: "success",
        });
      } else {
      }
    });
  });

</script>
