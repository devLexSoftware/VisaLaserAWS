

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 
  
  <script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

  
  <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


  <!-- Core plugin JavaScript-->
  
  <script type="text/javascript" src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>


  <!-- Custom scripts for all pages-->
  
  <script type="text/javascript" src="{{ asset('js/sb-admin-2.js') }}"></script>


  <!-- Page level plugins -->
  

  <!-- Page level custom scripts -->
  
  
  <script type="text/javascript" src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>

  
  <script type="text/javascript" src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


  
<script type="text/javascript">
  $(document).ready(function() {
    $('#dataTable').DataTable();
  } );

</script>




<script>
    $(document).ready(function() {
      setInterval(function() {
        
        $.ajax({
        url: 'dashboardPago',
        success:function(data)
        {
          debugger;
          $('#divPago').html(data);
        }
        });
      }, 5000);
    });
</script>
  
  
