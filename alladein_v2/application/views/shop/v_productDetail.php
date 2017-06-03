<div id="wrapper" class="container">    
    <section class="header_text sub">
        <img class="pageBanner" src="<?= base_url(); ?>assets/themes/images/pageBanner.png" alt="New products" >
        <h4><span>Product Detail <br /> <?=$button_api[0]->bap_name; ?></span></h4>
    </section>
    <section class="main-content">				
        <div class="row">						
            <div class="span9">
                <div class="row">
                    <div class="span4">
                        <iframe width="380" height="260" src="<?=$bap_info_url; ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="span5">
                        <address>
                            <table class="" style="width:100%;">
                                <tr>
                                    <td width="30%">Product Name</td>
                                    <td width="10%">:</td>
                                    <td><strong><?=$button_api[0]->bap_name; ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Product Code</td>
                                    <td>:</td>
                                    <td><?=$button_api[0]->bap_code; ?></td>
                                </tr>
                                <tr>
                                    <td>Availability</td>
                                    <td>:</td>
                                    <td><?=($button_api[0]->bap_status == 1)?("In Stock"):("Out of Stock"); ?></td>
                                </tr>
                                <tr>
                                    <td>Price in Gold</td>
                                    <td>:</td>
                                    <td><strong><?=number_format($button_api[0]->bap_gold, 1); ?>g DPG</strong></td>
                                </tr>
                                <tr>
                                    <td>Price in Silver</td>
                                    <td>:</td>
                                    <td><strong><?=number_format($button_api[0]->bap_silver, 1); ?>g DPS</strong></td>
                                </tr>
                                <tr>
                                    <td>Delivery Charge</td>
                                    <td>:</td>
                                    <td>
                                        <?=number_format($button_api[0]->bap_delivery_dpg, 1); ?>g DPG 
                                        / 
                                        <?=number_format($button_api[0]->bap_delivery_dps, 1); ?>g DPS
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><hr /></td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="span1" name="qty" /> 
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <button type="button" class="btn btn-inverse" id='btn_addtocart'>Add to Cart</button>
                                    </td>
                                </tr>
                            </table>								
                        </address>									
                    </div>							
                </div>
                <div class="row">
                    <div class="span9">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#desc">Description</a></li>
                            <li><a href="#image">Image</a></li>
                        </ul>							 
                        <div class="tab-content">
                            <div class="tab-pane active" id="desc">
                                <?=$button_api[0]->bap_desc; ?>
                            </div>
                            <div class="tab-pane" id="image">
                                <img style="max-height: 300px;" src="<?= $this->config->item('base_url_ori'); ?>assets/uploads/merchant/<?=$button_api[0]->bap_image; ?>" alt="" />
                            </div>
                        </div>							
                    </div>						
                    <div class="span9">	
                        <br>
                        <h4 class="title">
                            <span class="pull-left"><span class="text"><strong>Related</strong> Products</span></span>
                            <span class="pull-right">
                                <a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
                            </span>
                        </h4>
                        <div id="myCarousel-1" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails listing-products">
                                        <?php
                                        $i = 1;
                                        $size_button_apix = sizeof($other_prod);
                                        if (isset($other_prod) && !empty($other_prod)) {
                                            foreach ($other_prod as $op) {
                                                $bap_id = $op->bap_id;
                                                $bapidx = $this->my_func->dinarpal_encrypt($bap_id);
                                                $bap_image = $op->bap_image;
                                                $bap_info_urlx = $op->bap_info_url;
                                                $bap_info_urlx = str_replace('watch?v=', 'embed/', $bap_info_urlx);
                                                $bap_namex = $op->bap_name;
                                                $me_id = $op->me_id;
                                                $me_idx = $this->my_func->dinarpal_encrypt($me_id);
                                                $me_usernamex = $op->me_username;
                                                $bap_goldx = $op->bap_gold;
                                                $bap_silverx = $op->bap_silver;
                                                $bap_namex = $this->my_func->getShortString($bap_namex, 30);
                                                $me_usernamex = $this->my_func->getShortString($me_usernamex, 30);
                                        ?>
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>												
                                                <iframe width="250" height="188" src="<?=$bap_info_urlx; ?>" frameborder="0" allowfullscreen></iframe>
                                                <br/>
                                                <a href="<?=site_url('shop/productDetail/'.$bapidx); ?>" class="title"><?=$bap_namex; ?></a><br/>
                                                <a href="<?=site_url('shop/products/?u='.$me_idx); ?>" class="category"><?=$me_usernamex; ?></a>
                                                <p class="price">
                                                    <a href="<?=site_url('shop/productDetail/'.$bapidx); ?>">
                                                        <?=number_format($bap_goldx, 1); ?> Gram DPG <br /><?=number_format($bap_silverx, 1); ?> Gram DPS
                                                    </a>
                                                </p>
                                            </div>
                                        </li>
                                        <?php 
                                                if ($i % 3 == 0 && $i != $size_button_apix) {
                                                    echo "</ul></div><div class=\"item\"><ul class=\"thumbnails listing-products\">";
                                                }
                                                $i += 1;
                                            }
                                        } 
                                        ?>										
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span3 col">
                <?=$this->load->view('shop/v_sidebar', '', true); ?>
            </div>
        </div>
    </section>			
</div>		

<script>
    $(document).ready(function () {
        $("#btn_addtocart").click(function () {
            $("#btn_addtocart").addClass("disabled").attr("disabled", "").html("Processing ...");
            
        });
    });
</script>