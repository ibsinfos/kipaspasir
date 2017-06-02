   
	 
	 <section id="footer-bar">
	 
	      <div class="container"> 
                <div class="row" style="margin-left: 128px;">
                    <div class="span3" style="    width: 229px!important;">
                        <h4>Navigation</h4>
                        <ul class="nav">
                            <li><a href="./index.php">Homepage</a></li>  
                            <li><a href="./about.php">About Us</a></li>
                            <li><a href="./contact.php">Contact Us</a></li>
                            <li><a href="./cart.php">Your Cart</a></li>
                            <li><a href="https://www.dinarpal.com/index.php/login">Login</a></li>							
                        </ul>					
                    </div>
                    <div class="span3" style="    width: 229px!important;">
                        <h4>My Account</h4>
                        <ul class="nav">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Newsletter</a></li>
                        </ul>
                    </div>
                    <div class="span3" style="    width: 229px!important;">
                        <h4>User Manual</h4>
                        <ul class="nav">
                            <li><a href="#">How to use Alladein?</a></li>
                            <li><a href="#">How to buy?</a></li>
                            <li><a href="#">How to sell?</a></li>

                        </ul>
                    </div>
                    <div class="span3" style="    width: 229px!important;">
                        <h4>Social Media</h4>
                        <ul class="nav">
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Twitter</a></li>



                        </ul>
                    </div>			
                </div>	
			  </div>
            </section>
			
            <section id="copyright">
                <center>Alladein. Dinarpal Group. All right reserved 2017.</center>
            </section>  
			
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
		
		
		<script src="<?=base_url(); ?>assets/js/cbpHorizontalMenu.min.js"></script>
		<script>
			$(function() {
				cbpHorizontalMenu.init();
			});
		</script>
    </body>
</html>

