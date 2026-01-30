    <?php

        helper('data');
        $socialicons = getDataContents('socialicons');

    ?>
    <footer class="footer-wrapper footer-layout1" data-bg-src="assets/img/bg/footer_bg_1.jpg">
        <div class="widget-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="widget footer-widget">
                            <h3 class="widget_title">About Us</h3>
                            <div class="ot-widget-about">
                                <p class="footer-text">At VTAB SQUARE, we are a dynamic and emerging IT and services provider, dedicated to delivering excellence in data quality, security, and business solutions. Backed by over 18 years of our founder’s industry experience, we have been operating since 2019 with a mission to drive business transformation. Our services are designed to enhance operational efficiency and streamline processes, enabling sustainable growth and measurable results for our clients.</p>
                                <!--<div class="ot-social">-->
                                <!--    <a href=""><i class="fab fa-facebook-f"></i></a> <a href=""><i class="fab fa-twitter"></i></a>-->
                                <!--    <a href=""><i class="fab fa-linkedin-in"></i></a> <a href=""><i class="fab fa-whatsapp"></i></a>-->
                                <!--    <a href=""><i class="fab fa-youtube"></i></a>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">Links</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="">Home</a></li>
                                    <li><a href="about">About Us</a></li>
                                    <li><a href="services">Services</a></li>
                                    <li><a href="technologies">Technology</a></li>
                                    <li><a href="photos">Portfolio</a></li>
                                    <li><a href="blogs">Blog</a></li>
                                    <li><a href="career">Career</a></li>
                                    <li><a href="contact">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">SERVICES</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="services/category/1">Business Consulting</a></li>
                                    <li><a href="services/category/2">IT Solutions</a></li>
                                    <li><a href="services/category/5">IT Staffing</a></li>
                                    <!--<li><a href="services/category/3">Quality Testing</a></li>-->
                                    <!--<li><a href="services/category/4">Support</a></li>-->
                                    <li><a href="services/category/6">Training</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-2">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">TECHNOLOGY</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="technologies/category/1">App Development</a></li>
                                    <li><a href="technologies/category/2">Data Integration</a></li>
                                    <li><a href="technologies/category/3">Data Analytics & Business Intelligence</a></li>
                                    <li><a href="technologies/category/5">Database & Data Warehousing</a></li>
                                    <li><a href="technologies/category/4">Cloud Migration</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="widget footer-widget">
                            <h3 class="widget_title">Contact Us</h3>
                            <ul class="fa-ul" style="color: #8A99B4">
                                <li class="mb-3">
                                    <span class="fa-li">
                                        <span class="fas fa-map-marker-alt"></span>
                                    </span>
                                    11 Scott Street Wausau <br>WI USA 54403
                                </li>
                                <li class="mb-3">
                                    <span class="fa-li">
                                        <span class="fas fa-envelope"></span>
                                    </span>
                                    information@vtabsquare.com
                                </li>
                                <li class="mb-3">
                                    <span class="fa-li">
                                        <span class="fas fa-phone"></span>
                                    </span>
                                    +91 99625 97975
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container text-center">
                <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> <?= date('Y') ?> <a href="">VTAB SQUARE</a>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <div class="fixed-bottom-left">
        <div class="social-card p-0 border-0">
            <div class="ot-social mb-0 ms-3">
                <?php if ($socialicons['whatsapp'] ?? null): ?>
                <a class="mb-2" target="_blank" href="https://wa.me/<?= $socialicons['whatsapp'] ?>">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <?php endif; ?>

                <?php if ($socialicons['phone'] ?? null): ?>
                <a class="mb-2" target="_blank" href="tel:<?= $socialicons['phone'] ?>">
                    <i class="fa fa-phone"></i>
                </a>
                <?php endif; ?>

                <?php if ($socialicons['mail'] ?? null): ?>
                <a class="mb-2" target="_blank" href="mailto:<?= $socialicons['mail'] ?>">
                    <i class="fa fa-envelope"></i>
                </a>
                <?php endif; ?>

                <?php if ($socialicons['linkedin'] ?? null): ?>
                <a class="mb-2" target="_blank" href="<?= $socialicons['linkedin'] ?>">
                    <i class="fab fa-linkedin"></i>
                </a>
                <?php endif; ?>

                <?php if ($socialicons['facebook'] ?? null): ?>
                <a class="mb-2" target="_blank" href="<?= $socialicons['facebook'] ?>">
                    <i class="fab fa-facebook"></i>
                </a>
                <?php endif; ?>

                <?php if ($socialicons['instagram'] ?? null): ?>
                <a class="mb-2" target="_blank" href="<?= $socialicons['instagram'] ?>">
                    <i class="fab fa-instagram"></i>
                </a>
                <?php endif; ?>

                <?php if ($socialicons['youtube'] ?? null): ?>
                <a class="mb-2" target="_blank" href="<?= $socialicons['youtube'] ?>">
                    <i class="fab fa-youtube"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
