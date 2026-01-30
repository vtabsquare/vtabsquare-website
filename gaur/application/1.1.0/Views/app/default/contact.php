    <?= view('app/default/common/head_top') ?>

    <title>Contact - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <link rel="canonical" href="<?= config('Config\App')->baseURL ?>contact">
    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => 'Contact us']) ?>

    <div class="space">
        <div class="container">
            <div class="contact-feature-wrap">
                <div class="contact-feature">
                    <div class="box-icon icon-btn"><i class="fas fa-location-dot"></i></div>
                    <div class="media-body">
                        <h3 class="box-title">Our Address</h3>
                        <p class="box-text">11 Scott Street Wausau<br> WI USA 54403</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="contact-feature">
                    <div class="box-icon icon-btn"><i class="fas fa-phone"></i></div>
                    <div class="media-body">
                        <h3 class="box-title">Phone Number</h3>
                        <p class="box-text"><a href="">+91 99625 97975</a></p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="contact-feature">
                    <div class="box-icon icon-btn"><i class="fas fa-envelope"></i></div>
                    <div class="media-body">
                        <h3 class="box-title">Email Address</h3>
                        <p class="box-text"><a href="">information@vtabsquare.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-bottom" id="contact-sec">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 text-center text-lg-start">
                    <div class="pe-xxl-5 me-xl-4">
                        <div class="title-area mb-50">
                            <span class="sub-title"><span class="text">Have Any Question?</span></span>
                            <h2 class="sec-title">Let’s Discuss About Something</h2>
                            <p class="sec-text">
                                At our IT solution company, we are committed to providing exceptional customer service and support. If you are experiencing technical difficulties or need assistance with one of our services
                            </p>
                        </div>
                        <div class="social-card">
                            <h3 class="box-title">Follow Us:</h3>
                            <div class="ot-social">
                                <a target="_blank" href=""><i class="fab fa-facebook-f"></i></a> <a target="_blank" href=""><i class="fab fa-twitter"></i></a>
                                <a target="_blank" href=""><i class="fab fa-instagram"></i></a> <a target="_blank" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a target="_blank" href=""><i class="fab fa-youtube"></i></a>
                            </div>
                            <a target="_blank" href="" class="box-link">Get Google Map Directions</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mt-40 mt-xl-0">
                    <div class="contact-form1" data-bg-src="assets/img/bg/contact_bg_2.png" id="j-ar">
                        <h3 class="box-title">Fill The Contact Form</h3>
                        <p class="box-text">Feel free to contact with us, we don’t spam your email</p>

                        <ul class="list-unstyled j-error d-none"></ul>
                        <p class="alert alert-success j-success d-none"></p>

                        <form method="POST" class="input-label" data-url="contact">
                            <div class="row">
                                <div class="form-group line-input col-sm-6"><input type="text" class="form-control" name="name" id="name" /> <label for="name">Your Name*</label></div>
                                <div class="form-group line-input col-sm-6"><input type="email" class="form-control" name="email" id="email" /> <label for="email">Your Email*</label></div>
                                <div class="form-group line-input col-sm-6"><input type="tel" class="form-control" name="phone" id="number" /> <label for="number">Phone Number*</label></div>
                                <div class="form-group line-input col-sm-6"><input type="text" class="form-control" name="subject" id="subject" /> <label for="subject">Subject...</label></div>
                                <div class="form-group line-input col-12"><textarea name="message" id="message" cols="30" rows="3" class="form-control"></textarea> <label for="message">Your Message*</label></div>
                                <div class="form-btn col-12 mt-10"><button class="ot-btn style3">Get a Quote</button></div>
                            </div>
                            <p class="form-messages mb-0 mt-3"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/60b4da4e6699c7280da9e059/1f7179hjt';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <?= view('app/default/common/js/form') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
