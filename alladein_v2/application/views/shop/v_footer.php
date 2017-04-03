        </div>
        <script type="text/javascript">
            $(function () {
                $(document).ready(function () {
                    $('.flexslider').flexslider({
                        animation: "fade",
                        slideshowSpeed: 4000,
                        animationSpeed: 600,
                        controlNav: false,
                        directionNav: true,
                        controlsContainer: ".flex-container" // the container that holds the flexslider
                    });
                });
            });
            $(function () {
                $('#myTab a:first').tab('show');
                $('#myTab a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                })
            })
//            $(document).ready(function() {
//                $('.thumbnail').fancybox({
//                    openEffect  : 'none',
//                    closeEffect : 'none'
//                });
//
//                $('#myCarousel-2').carousel({
//                    interval: 2500
//                });								
//            });
        </script>
    </body>
</html>