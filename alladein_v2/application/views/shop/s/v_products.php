<div id="wrapper" class="container">    
    <section class="header_text sub">
        <img class="pageBanner" src="<?= base_url(); ?>assets/themes/images/pageBanner.png" alt="New products" >
        <h4><span><?=$title; ?></span></h4>
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
                            $me_id = $bap->me_id;
                            $me_idx = $this->my_func->dinarpal_encrypt($me_id);
                            $me_username = $bap->me_username;
                            $bap_gold = $bap->bap_gold;
                            $bap_silver = $bap->bap_silver;
                            $bap_name = $this->my_func->getShortString($bap_name, 30);
                            $me_username = $this->my_func->getShortString($me_username, 30);
                    ?>
                    <li class="span3">
                        <div class="product-box">
                            <span class="sale_tag"></span>
                            <iframe width="250" height="188" src="<?=$bap_info_url; ?>" frameborder="0" allowfullscreen></iframe>
                            <br/>
                            <a href="<?=site_url('shop/s/productDetail/'.$bapidx); ?>" class="title"><?=$bap_name; ?></a><br/>
                            <a href="<?=site_url('shop/s/products/?u='.$me_idx); ?>" class="category"><?=$me_username; ?></a>
                            <p class="price">
                                <a href="<?=site_url('shop/s/productDetail/'.$bapidx); ?>">
                                    <?=number_format($bap_gold, 1); ?> Gram DPG <br /><?=number_format($bap_silver, 1); ?> Gram DPS
                                </a>
                            </p>
                        </div>
                    </li>      
                    <?php 
//                            if ($i % 3 == 0 && $i != $size_button_api) {
//                                echo "</ul></div><div class=\"item\"><ul class=\"thumbnails\">";
//                            }
                            if ($i == 9) {
                                break;
                            }
                            $i += 1;
                        }
                    } else { 
                    ?>
                    <li class="span9">
                        <div class="product-box">
                            <center><em>No product available ..</em></center>
                        </div>
                    </li>
                    <?php } ?>
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
                <?=$this->load->view('shop/v_sidebar', '', true); ?>
            </div>
        </div>
    </section>
</div>			