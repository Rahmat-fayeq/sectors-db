
                <!-- Footer -->
                <footer class="footer text-right"  style="background-color:#0078d4;color:white;">
                <div class="container">
                        <div class="row">
                            <div class="col-xs-8">
                        ساخته شده توسط آمریت تکنالوژی معلوماتی| 'Developed by 'Information Technolgy Department
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->
            </div>
            <!-- end container -->

            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <a href="javascript:void(0);" class="right-bar-toggle">
                    <i class="zmdi zmdi-close-circle-o"></i>
                </a>
                <h4 class="">Notifications</h4>
                <div class="notification-list nicescroll">
                    <ul class="list-group list-no-border user-list">
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">Michael Zenaty</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-info">
                                    <i class="zmdi zmdi-account"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Signup</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">5 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-pink">
                                    <i class="zmdi zmdi-comment"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Message received</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">James Anderson</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-warning">
                                    <i class="zmdi zmdi-settings"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">Settings</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /Right-bar -->
        </div>
<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-rtl.min.js') }}"></script>
<script src="{{ asset('assets/js/detect.js') }}"></script>
<script src="{{ asset('assets/js/fastclick.js') }}"></script>

<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/js/jalaali.js') }}"></script>
<script src="{{ asset('assets/js/jquery.Bootstrap-PersianDateTimePicker.js') }}"></script>

<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
<!--Morris Chart-->
<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
<!-- Dashboard init -->
<script src="{{ asset('assets/pages/jquery.dashboard.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/jquery.core.js') }}"></script>
<script src="{{ asset('assets/js/jquery.app.js') }}"></script>
<!-- Modal-Effect -->
<script src="{{ asset('assets/plugins/custombox/dist/custombox.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custombox/dist/legacy.min.js') }}"></script>
<!-- file uploads js -->
<script src="{{ asset('assets/plugins/fileuploads/js/dropify.min.js') }}"></script>
<script type="text/javascript">
    $('.dropify').dropify({
        messages: {
            'default': 'انتخاب تصویر جدید',
            'replace': 'تغییر تصویر فعلی',
            'remove': 'برداشتن',
            'error': 'Ooops, something wrong appended.'
        },
        error: {
            'fileSize': 'سایز عکس بزرگ است (حداکثر 1MB).'
        }
    });
</script>
<!-- Datatables-->
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>
  <!-- Datatable init js -->
  <script src="{{ asset('assets/pages/datatables.init.js"></script>


  <script type="text/javascript">
      $(document).ready(function() {
          $('#datatable').dataTable();
          $('#datatable-keytable').DataTable( { keys: true } );
          $('#datatable-responsive').DataTable();
          $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
          var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
      } );
      TableManageButtons.init();

  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/js/select2.min.js" type="text/javascript"></script>
  <script type="text/javascript">
        $(document).ready(function() {
            $('#dept').select2();
        });

        $(document).ready(function() {
            $('#maktob_no').select2();
        });

        $(document).ready(function() {
            $('#city').select2();
        });
  </script>
  <script>
    $("#submit").click(function(e) {
        var file = document.getElementById("file");
        let size = file.files[0].size; 
        if (size > 2000000) {
            alert("File size must not be more than 2MB !");
            e.preventDefault(); 
        }
    });
</script>



</body>
</html>
