</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/global/vendors.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/mousetrap/mousetrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/layouts/vertical-dark-menu/app.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/assets/js/custom.js"></script>

<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/highlight/highlight.pack.js"></script>


<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<!-- <script src="<//?php echo BASE_URL; ?>Assets/admin/src/plugins/src/apex/apexcharts.min.js"></script> -->
<script src="<?php echo BASE_URL; ?>Assets/admin/src/assets/js/dashboard/dash_1.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<!-- JS de query -->
<script src="<?php echo BASE_URL; ?>Assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/js/jquery-migrate-1.2.1.min.js"></script>
<!-- JS de query -->

<!-- js alertas/ base url -->
<script src="<?php echo BASE_URL; ?>Assets/js/sweetalert2.all.min.js"></script>
<script>
  const base_url = '<?php echo BASE_URL; ?>';
</script>
<!-- js alertas/ base url -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/table/datatable/datatables.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/table/datatable/button-ext/jszip.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/table/datatable/button-ext/buttons.print.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/table/datatable/custom_miscellaneous.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!--  BEGIN CUSTOM SCRIPT FILE  -->
<!-- <script src="<//?php echo BASE_URL; ?>Assets/admin/src/assets/js/scrollspyNav.js"></script>
    <script>

        function addVideoInModal(btnSelector, videoSource, modalSelector, iframeHeight, iframeWidth, iframeContainer) {
            var myModal = new bootstrap.Modal(document.getElementById(modalSelector), {
                keyboard: false
            })            
            document.querySelector(btnSelector).addEventListener('click', function() {
                var src = videoSource;
                myModal.show('show');
                var ifrm = document.createElement("iframe");
                ifrm.setAttribute("src", src);
                ifrm.setAttribute('width', iframeWidth);
                ifrm.setAttribute('height', iframeHeight);
                ifrm.style.border = "0";
                ifrm.setAttribute("allow", "encrypted-media");
                document.querySelector(iframeContainer).appendChild(ifrm);
            })
        }
        
        addVideoInModal('#yt-video-link', 'https://www.youtube.com/embed/YE7VzlLtp-4', 'videoMedia1', '315', '560', '.yt-container')
        
        addVideoInModal('#vimeo-video-link', 'https://player.vimeo.com/video/1084537', 'videoMedia2', '315', '560', '.vimeo-container')

    </script>     -->
<!--  END CUSTOM SCRIPT FILE  -->

<!-- BEGIN THEME GLOBAL STYLE -->
<script src="<?php echo BASE_URL; ?>Assets/admin/src/assets/js/scrollspyNav.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/admin/src/plugins/src/sweetalerts2/custom-sweetalert.js"></script>
<!-- END THEME GLOBAL STYLE -->
</body>

</html>