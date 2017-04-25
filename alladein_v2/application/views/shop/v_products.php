<div id="wrapper" class="container">    
    <section class="header_text sub">
        <img class="pageBanner" src="<?= base_url(); ?>assets/themes/images/pageBanner.png" alt="New products" >
        <h4><span>New products</span></h4>
    </section>
    <section class="main-content">

        <div class="row">						
            <div class="span9">								
                <ul class="thumbnails listing-products">
                    <?php
                    $i = 1;
                    $size_button_api = sizeof($button_api);
                    if (isset($button_api) && !empty($button_api)) {
                        foreach ($button_api as $bap) {
                            $bap_id = $bap->bap_id;
                            $bapidx = $this->my_func->dinarpal_encrypt($bap_id);
                            $bap_image = $bap->bap_image;
                            $bap_info_url = $bap->bap_info_url;
                            $bap_info_url = str_replace('watch?v=', 'embed/', $bap_info_url);
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
<!--                            <a href="product_detail.html">
                                <img alt="" src="<?= base_url(); ?>assets/themes/images/ladies/10.jpg">
                            </a>-->
                            <iframe width="250" height="188" src="<?=$bap_info_url; ?>" frameborder="0" allowfullscreen></iframe>
                            <br/>
                            <a href="<?=site_url('shop/showProductDetail/'.$bapidx); ?>" class="title"><?=$bap_name; ?></a><br/>
                            <a href="<?=site_url('shop/showProducts'); ?>" class="category"><?=$me_username; ?></a>
                            <p class="price"><?=number_format($bap_gold, 1); ?> Gram DPG <br /><?=number_format($bap_silver, 1); ?> Gram DPS</p>
                        </div>
                    </li>      
                    <?php 
//                            if ($i % 3 == 0 && $i != $size_button_api) {
//                                echo "</ul></div><div class=\"item\"><ul class=\"thumbnails\">";
//                            }
                            $i += 1;
                        }
                    } 
                    ?>
                </ul>								
                <hr>
                <div class="pagination pagination-small pagination-centered">
                    <ul>
                        <li><a href="#">Prev</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                </div>
            </div>
            <div class="span3 col">
                <div class="block">	
                    <ul class="nav nav-list">
                        <li class="nav-header">TOP CATEGORIES</li>
                        <li><a href="products.html">Electronics</a></li>
                        <li ><a href="products.html">Women's Fashion</a></li>
                        <li><a href="products.html">Men's Fashion</a></li>
                        <li class="active"><a href="products.html">Home & Living</a></li>
                        <li><a href="products.html">Health & Beauty</a></li>
                        <li><a href="products.html">Food & Beverages</a></li>
                        <li><a href="products.html">Sports & Travel</a></li>
                        <li><a href="products.html">Groceries & More</a></li>

                    </ul>
                    <br/>
                    <ul class="nav nav-list below">
                        <li class="nav-header">Top Brands</li>
                        <li><a href="products.html">Mary Kay</a></li>
                        <li><a href="products.html">Nike</a></li>
                        <li><a href="products.html">Apple</a></li>
                        <li><a href="products.html">Sambal Mak Jenab</a></li>
                    </ul>
                </div>
                <div class="block">
                    <h4 class="title">
                        <span class="pull-left"><span class="text">Randomize</span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails listing-products">
                                    <li class="span3">
                                        <div class="product-box">
                                            <span class="sale_tag"></span>												
                                            <a href="product_detail.html"><img alt="" src="<?= base_url(); ?>assets/themes/images/ladies/10.jpg"></a><br/>
                                            <a href="product_detail.html" class="title">Aniza Coklat Sedap</a><br/>
                                            <a href="#" class="category">30% less for 5 first customers</a>
                                            <p class="price">3.0 Gram DPS <br> 0.2 Gram DPG</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="item">
                                <ul class="thumbnails listing-products">
                                    <li class="span3">
                                        <div class="product-box">												
                                            <a href="product_detail.html"><img alt="" src="<?= base_url(); ?>assets/themes/images/ladies/10.jpg"></a><br/>
                                            <a href="product_detail.html" class="title">Aniza Coklat Sedap</a><br/>
                                            <a href="#" class="category">30% less for 5 first customers</a>
                                            <p class="price">3.0 Gram DPS <br> 0.2 Gram DPG</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block">								
                    <h4 class="title"><strong>Best</strong> Seller</h4>								
                    <ul class="small-product">
                        <li>
                            <a href="#" title="Praesent tempor sem sodales">
                                <img src="<?= base_url(); ?>assets/themes/images/ladies/10.jpg" alt="Praesent tempor sem sodales">
                            </a>
                            <a href="#">Aniza Coklat Sedap</a>
                        </li>
                        <li>
                            <a href="#" title="Luctus quam ultrices rutrum">
                                <img src="<?= base_url(); ?>assets/themes/images/ladies/10.jpg" alt="Luctus quam ultrices rutrum">
                            </a>
                            <a href="#">Aniza Coklat Sedap</a>
                        </li>
                        <li>
                            <a href="#" title="Fusce id molestie massa">
                                <img src="<?= base_url(); ?>assets/themes/images/ladies/10.jpg" alt="Fusce id molestie massa">
                            </a>
                            <a href="#">Aniza Coklat Sedap</a>
                        </li>   
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>			