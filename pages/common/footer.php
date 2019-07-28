      <footer class="footer">
        <div class="container-fluid">
          <ul class="nav">
            <li class="nav-item">
              <a href="../../../index.php" target="_blank" class="nav-link">
               Website  
              </a>
            </li>
            <li class="nav-item">
              <a href="../../../about.php" target="_blank" class="nav-link">
                About Us
              </a>
            </li>
            <li class="nav-item">
              <a href="https://www.balworld.in/projects.php" target="_blank" class="nav-link">
                Our Projects
              </a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/balworld" target="_blank" class="nav-link">
                GitHub
              </a>
            </li>
            <li class="nav-item">
              <a href="mailto:info@balworld.in?subject=Mail from Bal World Admin" target="_blank" class="nav-link">
                Email Us
              </a>
            </li>
          </ul>
          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script>            
              <a href="../../../index.php" class="text-info" target="_blank">Bal World Technologies</a>
              . Made with <i class="fa fa-heart text-danger"></i> in Thrissur.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/bwjs.min.js?v=1.0.0"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/summernote-lite.js"></script>
<script>
$('#datatable').dataTable( {
    "language": {
      "emptyTable": "Well, Its seems nothing here."
    }
} );
</script>
<script>
$(document).ready(function() {
  $('#richeditor').summernote();
});
</script>
<script>
function paymentcomplete()
  {swal("No Pending Payments!", "Thankyou for Working With Us", "success");}
</script>

</body>

</html>