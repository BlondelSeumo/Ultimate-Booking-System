<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 5/7/2019
 * Time: 3:03 PM
 */
$status = 'normal';
if(isset($vv['status']))
    $status = $vv['status'];

$classic = false;
if(isset($classic))
    $classic = true;

$path_img = '';
if(isset($vv['layout']))
    $path_img = 'classic/';
?>
<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="item <?php echo $status; ?>">
        <a href="<?php echo esc_url($vv['url']); ?>">
            <?php if($status != 'soon'){ ?>
                <!--<span class="view-more">View More</span>-->
            <?php } ?>
            <div class="new">New</div>
            <!--<div class="soon">Soon</div>-->
            <div class="soon">Hot</div>
            <img src="<?php echo $url . '/img/demo/classic/' . $vv['thumb']; ?>" alt="<?php echo $vv['heading']; ?>" class="img-responsive"/>
        </a>
        <h4><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 9" style="enable-background:new 0 0 26 9;" xml:space="preserve">
                    <path d="M26,4.7C26,4.6,26,4.4,26,4.3c0-0.1-0.1-0.1-0.1-0.2l-3.5-3.5c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7L24.3,4
                    H0.5C0.2,4,0,4.2,0,4.5S0.2,5,0.5,5h23.8l-2.7,2.7c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l3.5-3.5
                    C25.9,4.8,25.9,4.8,26,4.7z"></path>
                </svg><?php echo $vv['heading']; ?></h4>
    </div>
</div>
