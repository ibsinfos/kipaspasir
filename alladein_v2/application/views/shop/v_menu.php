<div id="head" class="container">

    <link href="<?php echo base_url(); ?>assets/css/component.css" rel="stylesheet">
<!--<link href="<?php echo base_url(); ?>assets/css/mobile.css" rel="stylesheet">-->
    <link href="<?php echo base_url(); ?>assets/theme/css/main.css" rel="stylesheet">

    <div id="top-bar" class="container">
        <div class="row">
            <div class="span2">
                <a href="<?= site_url('shop'); ?>" ><img style="display: block; margin: 0 auto;" src="<?= base_url(); ?>assets/themes/images/logo.png" class="site_logo" alt=""></a>
            </div>
            <div class="span5">
                <form method="GET" class="search_form" action="<?=site_url('shop/products'); ?>">
                    <input type="text" class="input-block-level search-query" style="color: #000;" Placeholder="Search for product, brands, shops" name="carida" value='<?=$carida_str; ?>' />
                </form>
            </div>

            <div class="span4">
                <div class="account pull-right">
                    <ul class="user-menu">				
                        <li><a href="#!">My Account</a></li>
                        <li>
                            <a href="<?= site_url('shop/myCarts'); ?>">
                                Your Cart
                                <span class="timbulnoti">3</span>
                            </a>
                        </li>
                        <li><a href="<?= site_url('shop/checkout'); ?>">Checkout</a></li>					
                        <li><a href="<?= site_url('shop/login'); ?>"> Sign In</a>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="desktopmenu">

        <nav id="cbp-hrmenu" class="cbp-hrmenu">
            <ul>
                <?php
                if (isset($category_parent) && !empty($category_parent)) {
                    foreach ($category_parent as $cp) {
                        $bac_id2 =  $cp->bac_id;
                        $category_parent2 = $this->m_button_api_category->getParent($bac_id2);
                ?>
                <li>
                    <a href="#"><?=$cp->bac_desc; ?></a>
                    <div class="cbp-hrsub">
                        <div class="cbp-hrsub-inner"> 
                            <?php
                            if (isset($category_parent2) && !empty($category_parent2)) {
                                foreach ($category_parent2 as $cp2) {
                                    $bac_id3 = $cp2->bac_id;
                                    $category_parent3 = $this->m_button_api_category->getParent($bac_id3);
                            ?>
                            <div width="206" height="355">
                                <h4><?=$cp2->bac_desc; ?></h4>
                                <ul>
                                    <?php
                                    if (isset($category_parent3) && !empty($category_parent3)) {
                                        foreach ($category_parent3 as $cp3) {
                                            $bac_id3 = $cp3->bac_id;
                                            $bacidx = $this->my_func->dinarpal_encrypt($bac_id3);
                                            $bac_desc3 = $cp3->bac_desc;
                                    ?>
                                    <li><a href="<?=site_url('shop/products?c='.$bacidx); ?>"><?=$bac_desc3; ?></a></li>
                                    <?php } } ?>
                                </ul>
                            </div>
                            <?php } } ?>
                        </div><!-- /cbp-hrsub-inner -->
                    </div><!-- /cbp-hrsub -->
                </li>
                <?php } } ?>
            </ul>
        </nav>
    </div>

    <!--mobilemenu-->

    <div id="mobilemenu">
        <nav id="cbp-hrmenu" class="cbp-hrmenu">
            <ul>
                <?php
                if (isset($category_parent) && !empty($category_parent)) {
                    foreach ($category_parent as $cp) {
                        $bac_id2 =  $cp->bac_id;
                        $category_parent2 = $this->m_button_api_category->getParent($bac_id2);
                ?>
                <li>
                    <a href="#"><?=$cp->bac_desc; ?></a>
                    <div class="cbp-hrsub">
                        <div class="cbp-hrsub-inner"> 
                            <?php
                            if (isset($category_parent2) && !empty($category_parent2)) {
                                foreach ($category_parent2 as $cp2) {
                                    $bac_id3 = $cp2->bac_id;
                                    $category_parent3 = $this->m_button_api_category->getParent($bac_id3);
                            ?>
                            <div width="206" height="355">
                                <h4><?=$cp2->bac_desc; ?></h4>
                                <ul>
                                    <?php
                                    if (isset($category_parent3) && !empty($category_parent3)) {
                                        foreach ($category_parent3 as $cp3) {
                                            $bac_id3 = $cp3->bac_id;
                                            $bacidx = $this->my_func->dinarpal_encrypt($bac_id3);
                                            $bac_desc3 = $cp3->bac_desc;
                                    ?>
                                    <li><a href="<?=site_url('shop/products?c='.$bacidx); ?>"><?=$bac_desc3; ?></a></li>
                                    <?php } } ?>
                                </ul>
                            </div>
                            <?php } } ?>
                        </div><!-- /cbp-hrsub-inner -->
                    </div><!-- /cbp-hrsub -->
                </li>
                <?php } } ?>
            </ul>
        </nav>
    </div>
</div>

<style>
    .timbulnoti {
        padding: 3px 7px 3px 7px;
        background: #cc0000;
        color: #ffffff;
        font-weight: bold;
        margin-left: 7px;
        border-radius: 9px;
        position: absolute;
        margin-top: -11px;
        font-size: 11px;
    }
</style>