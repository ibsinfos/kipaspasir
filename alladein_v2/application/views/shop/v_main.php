
            <section  class="homepage-slider" id="home-slider">
                <div class="flexslider">
                    <ul class="slides">

                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/gadget.jpg" alt="" />
                            <div class="intro">
                                <h1>Season sale</h1>
                                <p><span>Up to 30% Off</span></p>
                                <p><span>On selected items online and in stores</span></p>
                            </div>
                        </li>
                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/men2.jpg" alt="" />
                            <div class="intro">
                                <h1>Season sale</h1>
                                <p><span>Up to 30% Off</span></p>
                                <p><span>Be the early bird to grab the stuff with discount</span></p>
                            </div>
                        </li>
                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/ab1.jpg" alt="" />
                        </li>

                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/cycle.jpg" alt="" />
                        </li>
                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/craft.jpg" alt="" />
                        </li>
                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/women.jpg" alt="" />
                        </li>
                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/hu.jpg" alt="" />
                        </li>
                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/cycle.jpg" alt="" />
                        </li>
                        <li>
                            <img src="<?=base_url(); ?>assets/themes/images/carousel/book.jpg" alt="" />
                        </li>
                    </ul>
                </div>			
            </section>
            <section class="header_text">
                <strong>Alladein.com</strong> is a leading price comparison site that allows you shop online for the best deals and lowest prices. You will satisfied with the great values.			
                <br/>Don't miss out to take a look our <strong>Online Shop.</strong>
            </section>
			
			
		<div id="wrapper" class="container">    
            <section class="main-content">
                <div class="row">
                    <div class="span12">													
                        <div class="row">
                            <div class="span12">
                                <h4 class="title">
                                    <span class="pull-left"><span class="text"><span class="line">More <strong>Products</strong></span></span></span>
                                    <span class="pull-right">
                                        <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
                                    </span>
                                </h4>
                                <div id="myCarousel" class="myCarousel carousel slide">
                                    <div class="carousel-inner">
                                        <div class="active item">
                                            <ul class="thumbnails">	
                                                <?php
                                                $i = 1;
                                                $size_button_api = sizeof($button_api);
                                                if (isset($button_api) && !empty($button_api)) {
                                                    foreach ($button_api as $bap) {
                                                        $bap_id = $bap->bap_id;
                                                        $bapidx = $this->my_func->dinarpal_encrypt($bap_id);
                                                        $bap_image = $bap->bap_image;
                                                        $bap_info_url = $bap->bap_info_url;
                                                        $bap_name = $bap->bap_name;
                                                        $me_username = $bap->me_username;
                                                        $bap_gold = $bap->bap_gold;
                                                        $bap_silver = $bap->bap_silver;
                                                        $bap_name = $this->my_func->getShortString($bap_name, 30);
                                                        $me_username = $this->my_func->getShortString($me_username, 30);
                                                ?>
                                                <li class="span3">
                                                    <div class="product-box">
                                                        <span class="sale_tag"></span>
                                                        <!--<img src="<?=$this->config->item('base_url_ori'); ?>assets/uploads/merchant/<?=$bap_image; ?>" class="img-rounded" style="width: 250px; height: 188px;" />-->
                                                        <iframe width="250" height="188" src="<?=$bap_info_url; ?>" frameborder="0" allowfullscreen></iframe>
                                                        <a href="<?=site_url('shop/showProductDetail/'.$bapidx); ?>" class="title"><?=$bap_name; ?></a><br/>
                                                        <a href="<?=site_url('shop/showProducts'); ?>" class="category"><?=$me_username; ?></a>
                                                        <p class="price"><?=number_format($bap_gold, 1); ?> Gram DPG <br /><?=number_format($bap_silver, 1); ?> Gram DPS</p>
                                                    </div>
                                                </li>
                                                <?php 
                                                        if ($i % 4 == 0 && $i != $size_button_api) {
                                                            echo "</ul></div><div class=\"item\"><ul class=\"thumbnails\">";
                                                        }
                                                        $i += 1;
                                                    }
                                                } 
                                                ?>
                                            </ul>
                                        </div>
<!--                                        <div class="item">
                                            <ul class="thumbnails">
                                                <li class="span3">
                                                    <div class="product-box">
                                                       <a href="<?=site_url('shop/showProductDetail'); ?>"><iframe width="250" height="188" src="https://www.youtube.com/embed/90OrB5km3w0" frameborder="0" allowfullscreen></iframe></a>
                                                        <a href="<?=site_url('shop/showProductDetail'); ?>" class="title">Ritz Minyak Wangi</a><br/>
                                                        <a href="<?=site_url('shop/showProducts'); ?>" class="category">Rose Geranium Orange Energize</a>
                                                        <p class="price">4.0 Gram DPS <br>0.1 Gram DPG</p>
                                                    </div>
                                                </li>
                                                <li class="span3">
                                                    <div class="product-box">
                                                        <a href="<?=site_url('shop/showProductDetail'); ?>"><iframe width="250" height="188" src="https://www.youtube.com/embed/90OrB5km3w0" frameborder="0" allowfullscreen></iframe></a>
                                                        <a href="<?=site_url('shop/showProductDetail'); ?>" class="title">Ritz Minyak Wangi</a><br/>
                                                        <a href="<?=site_url('shop/showProducts'); ?>" class="category">Rose Geranium Orange Energize</a>
                                                        <p class="price">4.0 Gram DPS <br>0.1 Gram DPG</p>
                                                    </div>
                                                </li>
                                                <li class="span3">
                                                    <div class="product-box">
                                                        <a href="<?=site_url('shop/showProductDetail'); ?>"><iframe width="250" height="188" src="https://www.youtube.com/embed/90OrB5km3w0" frameborder="0" allowfullscreen></iframe></a>
                                                        <a href="<?=site_url('shop/showProductDetail'); ?>" class="title">Ritz Minyak Wangi</a><br/>
                                                        <a href="<?=site_url('shop/showProducts'); ?>" class="category">Rose Geranium Orange Energize</a>
                                                        <p class="price">4.0 Gram DPS <br>0.1 Gram DPG</p>
                                                    </div>
                                                </li>
                                                <li class="span3">
                                                    <div class="product-box">
                                                       <a href="<?=site_url('shop/showProductDetail'); ?>"><iframe width="250" height="188" src="https://www.youtube.com/embed/90OrB5km3w0" frameborder="0" allowfullscreen></iframe></a>
                                                        <a href="<?=site_url('shop/showProductDetail'); ?>" class="title">Ritz Minyak Wangi</a><br/>
                                                        <a href="<?=site_url('shop/showProducts'); ?>" class="category">Rose Geranium Orange Energize</a>
                                                        <p class="price">4.0 Gram DPS <br>0.1 Gram DPG</p>
                                                    </div>
                                                </li>																																	
                                            </ul>
                                        </div>-->
                                    </div>							
                                </div>
                            </div>						
                        </div>
                        <div class="row feature_box">						
                            <div class="span4">
                                <div class="service">
                                    <div class="responsive">	
                                        <img src="<?=base_url(); ?>assets/themes/images/feature_img_2.png" alt="" />
                                        <h4>MODERN <strong>DESIGN</strong></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="span4">	
                                <div class="service">
                                    <div class="customize">			
                                        <img src="<?=base_url(); ?>assets/themes/images/feature_img_1.png" alt="" />
                                        <h4>FREE <strong>SHIPPING</strong></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="service">
                                    <div class="support">	
                                        <img src="<?=base_url(); ?>assets/themes/images/feature_img_3.png" alt="" />
                                        <h4>24/7 LIVE <strong>SUPPORT</strong></h4>
                                    </div>
                                </div>
                            </div>	
                        </div>		
                    </div>				
                </div>
            </section>
			
			
			
			
            <section class="our_client">
                <h4 class="title"><span class="text">Manufactures</span></h4>
                <div class="row" >					
                    <div class="span4" style="    width: 363px;
    /* line-height: 8px; */
    ">
                        <a href="#"><img alt="" src="<?=base_url(); ?>assets/themes/images/clients/14.png"></a>
                    </div>
                    <div class="span4" style="    width: 363px;
    /* line-height: 8px; */
    ">
                        <a href="#"><img alt="" src="<?=base_url(); ?>assets/themes/images/clients/35.png"></a>
                    </div>
                    <div class="span4" style="    width: 363px;
    /* line-height: 8px; */
    ">
                        <a href="#"><img alt="" src="<?=base_url(); ?>assets/themes/images/clients/1.png"></a>
                    </div>
					</div>
					
				 <div class="row" >		
					
                    <div class="span4" style="    width: 363px;
    /* line-height: 8px; */
    ">
                        <a href="#"><img alt="" src="<?=base_url(); ?>assets/themes/images/clients/2.png"></a>
                    </div>
					
					
                    <div class="span4" style="    width: 363px;
    /* line-height: 8px; */
    ">
                        <a href="#"><img alt="" src="<?=base_url(); ?>assets/themes/images/clients/3.png"></a>
                    </div>
					
					
                    <div class="span4" style="    width: 363px;
    /* line-height: 8px; */
    ">
                        <a href="#"><img alt="" src="<?=base_url(); ?>assets/themes/images/clients/4.png"></a>
                    </div>
                </div>
				</div>
				<br><br>
            </section>
          </div>