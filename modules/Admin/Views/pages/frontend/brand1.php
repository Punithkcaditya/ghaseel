<?= $this->extend("layouts/mainfifth") ?>

<?= $this->section("content") ?>


<div id="preloader">
    <div class="spinner-border color-highlight" role="status"></div>
</div>

<div id="page">

    <!-- header and footer bar go here-->
    <div class="header header-fixed header-auto-show header-logo-app">
        <a href="index.html" class="header-title">Autobilbayt</a>
        <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
    </div>


    <div class="page-content">

        <div class="page-title page-title-small nobackdrnd">




            <div class="location_show">
                <h2><a href="#" class="navigate" data-menu="menu-success-1" href="#" id="show-bottom"><?= !empty(
                    get_cookie("location")
                )
                    ? get_cookie("location")
                    : "Location" ?>
                        <i class='fas fa-angle-down' style='font-size:13px'></i></a>

                </h2>

            </div>








            <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="<?= base_url(
                "images/avatars/5s.png"
            ) ?>"></a>
            <!-- <a href="#" data-menu="menu-main" class="bg-fade-highlight-light  preload-img" ><i class="fa-solid fa-bars" style="font-size: 26px;"></i></a> -->

        </div>
        <div class="card header-card shape-rounded" data-card-height="150">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
        </div>



        <!-- MODAL CONTENT SAMPLE STARTS HERE -->


        <!-- MODAL CONTENT SAMPLE ENDS HERE -->

        <div id="menu-success-1" class="menu menu-box-modal maystyle " >
            <a href="#" class="close-menus" onClick="window.location.reload();"><i class="fa fa-window-close" aria-hidden="true"></i></a>
            <div class="accordion" id="accordion-1">

                <?php //    echo '<pre>';
                //    print_r($cities);
                if (!empty($cities)):

                    $i = 1;
                    foreach ($cities as $main_menus): ?>
                        <div class="mb-0">
                            <button class="btn accordion-btn no-effect color-theme" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>">
                                <i class="fa-solid fa-location-pin"></i>
                                <?= $main_menus->city_name ?>
                                <i class="fa fa-chevron-down font-10 accordion-icon"></i>
                            </button>
                            <div id="collapse<?= $i ?>" class="collapse" data-bs-parent="#accordion-1">
                                <div class="pt-1 pb-2 ps-3 pe-3">
                                    <?php
                                    $var = explode(
                                        ",",
                                        $main_menus->differentlocations
                                    );
                                    foreach ($var as $rows): ?>
                                        <input type="hidden" name="location" id="location" class="form-control" value="<?php echo !empty(
                                            $rows
                                        )
                                            ? $rows
                                            : ""; ?>">
                                        <p class="location" data-productid="<?php echo $main_menus->id; ?>" data-productname="<?php echo $rows; ?>"><?= $rows ?></p>

                                    <?php endforeach;
                                    ?>

                                </div>
                            </div>
                        </div>

                    <?php $i++;endforeach;
                    ?>
                <?php
                endif; ?>

            </div>
        </div>



        <!-- display from bottom start -->









        <!-- display from bottom end -->






        <div class="card card-style">


        </div>


        <div class="card card-style" style="padding: 3px;">
            <div class="content">
                <h4 class="mb-0">Choose Brands</h4>

            </div>
            <div class="divider mb-0"></div>




        <div class="row text-center mb-0">




            <!-- car for trial -->
            <?php //    echo '<pre>';
            //    print_r($cars);
            if (!empty($brands)):
                $i = 1;
                foreach ($brands as $main_menus): ?>

                    <a href="<?php echo site_url("/models/".$main_menus->id); ?>" class="col-6 brands <?= check($i) ? "ps-2" : "pe-2" ?>"  data-brandid="<?php echo $main_menus->id ?>" data-brandname="<?php echo $main_menus->make_name ?>">
                        <div class="card card-style <?= check($i)
                            ? "ms-0"
                            : "me-0" ?> mb-3">
                            <h1 class="center-text pt-4 mt-2">
                                <img src="<?= base_url(
                                    "uploads/" . $main_menus->avatar
                                ) ?>" alt="<?=  $main_menus->make_name  ?>" style="width: 30%;"/>
                            </h1>
                            <h4 class="color-theme font-600"><?= $main_menus->make_name ?></h4>

                            <p class="font-10 opacity-30 mb-1">Tap to Select</p>
                        </div>
                    </a>


            <?php $i++;endforeach;
            endif; ?>

            <!-- car for trial end -->


            <?php function check($number)
            {
                if ($number % 2 == 0) {
                    return true;
                } else {
                    return false;
                }
            } ?>


        </div>
        <?php if ($brands <= 0) : ?>
                    <p class="font-600 pb-1" style="text-align: center;">No records found</p>
                    <?php endif ?>
        </div>

        <!-- footer and footer card-->
        <div class="footer" >
    
    
        <div class="footer card card-style mx-0 mb-0">
    <a href="#" class="footer-title pt-4">AUTOBILBAYT</a>
    <p class="text-center font-12 mt-n1 mb-3 mt-3 opacity-70">
        Satisfaction is our  <span class="color-highlight">goal</span> 
    </p>
    <!-- <p class="boxed-text-l">
        Built to match the design trends and give your page the awesome facelift it deserves.
    </p> -->
    <div class="text-center mb-3">
        <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-phone"><i class="fa fa-phone"></i></a>
        <a href="#" data-menu="menu-share" class="icon icon-xs rounded-sm me-1 shadow-l bg-red-dark"><i class="fa fa-share-alt"></i></a>
        <a href="#" class="back-to-top icon icon-xs rounded-sm shadow-l bg-highlight color-white"><i class="fa fa-arrow-up"></i></a>
    </div>
    <p class="footer-copyright pb-3 mb-1">Copyright &copy; Enabled <span id="copyright-year">2022</span>. All Rights Reserved.</p>
</div>
<div class="footer-card card shape-rounded bg-20" style="height:230px">
    <div class="card-overlay bg-highlight opacity-90"></div>
</div>

    </div>



        <div class="mylocation" id="mylocation"></div>
    </div>
    <!-- end of page content-->


    <div id="menu-share" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-load="menu-share.html" data-menu-height="420" data-menu-effect="menu-over">
    </div>

    <div id="menu-highlights" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-load="menu-colors.html" data-menu-height="510" data-menu-effect="menu-over">
    </div>

    <div id="menu-main" class="menu menu-box-right menu-box-detached rounded-m" data-menu-width="260"  data-menu-active="nav-pages" data-menu-effect="menu-over">
    
    <div class="menu-header">
    <a href="#" data-toggle-theme class="border-right-0 vishid"><i class="fa font-12 color-yellow-dark fa-lightbulb"></i></a>
    <a href="#" data-menu="menu-highlights" class="border-right-0 vishid"><i class="fa font-12 color-green-dark fa-brush"></i></a>
    <a href="#" data-menu="menu-share" class="border-right-0 vishid"><i class="fa font-12 color-red-dark fa-share-alt"></i></a>
    <a href="index-settings.html" class="border-right-0 vishid"><i class="fa font-12 color-blue-dark fa-cog"></i></a>
    <a href="#" class="close-menu border-right-0"><i class="fa font-12 color-red-dark fa-times"></i></a>
</div>

<div class="menu-logo text-center">
    <a href="#"><img class="rounded-circle bg-highlight" width="80" src="images/avatars/5s.png"></a>
    <h1 class="pt-3 font-800 font-28 text-uppercase">AUTOBILBAYT</h1>
    <!-- <p class="font-11 mt-n2">Put a little <span class="color-highlight">color</span> in your life.</p> -->
</div>

<div class="menu-items mb-4">
    <h5 class="text-uppercase opacity-20 font-12 pl-3">Menu</h5>
    <a href="#" data-submenu="sub-contact">
        <i data-feather="mail" data-feather-line="1" data-feather-size="16" data-feather-color="blue-dark" data-feather-bg="blue-fade-light"></i>
        <span>Contact</span>
        <strong class="badge bg-highlight color-white"></strong>
        <i class="fa fa-circle"></i>
    </a>
    <div id="sub-contact" class="submenu">
        <a href="contact.html" id="nav-contact"><i class="fa fa-envelope color-blue2-dark font-16 opacity-30"></i><span>Email</span><i class="fa fa-circle"></i></a>
        <a href="#"><i class="fa fa-phone color-green1-dark font-16 opacity-50"></i><span>Phone</span><i class="fa fa-circle"></i></a>
        <a href="#"><i class="fab fa-whatsapp color-whatsapp font-16 opacity-30"></i><span>WhatsApp</span><i class="fa fa-circle"></i></a>
    </div>
    <a id="nav-settings" href="index-settings.html">
        <i data-feather="settings" data-feather-line="1" data-feather-size="16" data-feather-color="gray-light" data-feather-bg="gray-fade-light"></i>
        <span>Settings</span>
        <i class="fa fa-circle"></i>
    </a>
    <a href="#" class="close-menu">
        <i data-feather="x" data-feather-line="3" data-feather-size="16" data-feather-color="red-dark" data-feather-bg="red-fade-dark"></i>
        <span>Close</span>
        <i class="fa fa-circle"></i>
    </a>
    <a id="nav-pages" href="index-pages.html" class="vishid">
        <i data-feather="file" data-feather-line="1" data-feather-size="16" data-feather-color="brown-dark" data-feather-bg="brown-fade-light"></i>
        <span>Pages</span>
        <i class="fa fa-circle"></i>
    </a>

 
</div>

<div class="text-center">
    <a href="#" class="icon icon-xs mr-1 rounded-s bg-facebook"><i class="fab fa-facebook"></i></a>
    <a href="#" class="icon icon-xs mr-1 rounded-s bg-twitter"><i class="fab fa-twitter"></i></a>
    <a href="#" class="icon icon-xs mr-1 rounded-s bg-instagram"><i class="fab fa-instagram"></i></a>
    <a href="#" class="icon icon-xs mr-1 rounded-s bg-linkedin"><i class="fab fa-linkedin-in"></i></a>
    <a href="#" class="icon icon-xs rounded-s bg-whatsapp"><i class="fab fa-whatsapp"></i></a>
    <p class="mb-0 pt-3 font-10 opacity-30">Copyright <span class="copyright-year"></span> Enabled. All rights reserved</p>
</div>

</div>



</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
    $(document).ready(function() {

        myFunction();

        function myFunction() {
            var data = "<?php echo get_cookie("location"); ?>";
            if (data != null && data != '') {
                console.log(data);
            } else {
                document.getElementById("show-bottom").click();
            }

        }



        $('.location').click(function() {
            var product_id = $(this).data("productid");
            var product_name = $(this).data("productname");
            // console.log(product_name);

            $.ajax({
                url: '<?= base_url() ?>/locate',
                method: "post",
                data: {
                    product_id: product_id,
                    product_name: product_name
                },
                success: function(data) {
                    //$('#detail_cart').html(data);
                    window.location.reload();
                },
                error: function(response) {

                    console.log(response);
                }
            });
        });




        
// ajax 2

$('.brands').click(function() {
        var brandid = $(this).data("brandid");
        var brandname = $(this).data("brandname");
        $.ajax({
            url: '<?= base_url() ?>/brandstore',
            method: "post",
            data: {
                brandid: brandid,
                brandname: brandname
            },
            success: function(data) {
                //$('#detail_cart').html(data);
                console.log(response);
            },
            error: function(response) {

                console.log(response);
            }
        });
    });




    

});














</script>

<?= $this->endSection() ?>
