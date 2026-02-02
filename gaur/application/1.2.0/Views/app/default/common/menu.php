    <div class="preloader">
        <button class="ot-btn preloaderCls style3">Cancel Preloader</button>
        <div class="preloader-inner"><span class="loader"></span></div>
    </div>
    <div class="ot-menu-wrapper">
        <div class="ot-menu-area text-center">
            <button class="ot-menu-toggle"><i class="fas fa-times"></i></button>
            <div class="mobile-logo">
                <a href=""><img src="assets/img/logo.png" alt="Vtabsquare" width="130" /></a>
            </div>
            <div class="ot-mobile-menu">
                <ul>
                    <li><a href="">Home</a></li>
                    <li class="menu-item-has-children">
                        <a href="about">About Us</a>
                        <ul class="sub-menu">
                            <li><a href="about/journey">Journey</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="services">Services</a>
                        <ul class="sub-menu">
                            <li><a href="services/business-consulting">Business Consulting</a></li>
                            <li><a href="services/it-solutions">IT Solutions</a></li>
                            <li><a href="services/it-staffing">IT Staffing</a></li>
                            <li><a href="services/digital-marketing">Digital Marketing</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="technologies">Technology</a>
                        <ul class="sub-menu">
                            <li><a href="technologies/app-development">App Development</a></li>
                            <li><a href="technologies/data-integration">Data Integration</a></li>
                            <li><a href="technologies/data-analytics-business-intelligence">Data Analytics & Business Intelligence</a></li>
                            <li><a href="technologies/database-data-warehousing">Database & Data Warehousing</a></li>
                            <li><a href="technologies/cloud-migration">Cloud Migration</a></li>
                        </ul>
                    </li>
                    <li><a href="contact">Contact</a></li>
                    <li><a href="case-studies">Case Studies</a></li>
                </ul>
            </div>
        </div>
    </div>
    <header class="ot-header header-layout1">
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                    <div class="col-auto d-none d-lg-block"><p class="header-notice"></p></div>
                    <div class="col-auto">
                        <div class="header-links2">
                            <ul>
                                <li class="d-none d-sm-inline-block">
                                    <div class="links-menu">
                                        <ul>
                                            <li><a href="blogs">Blog</a></li>
                                            <li><a href="career">Careers</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li><i class="far fa-envelope"></i><a href="mailto:info@vtabsquare.com">info@vtabsquare.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo py-md-0">
                                <a href=""><img src="assets/img/logo.png" alt="Vtabsquare" width="130" /></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li><a href="">Home</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="about">About Us</a>
                                        <ul class="sub-menu">
                                            <li><a href="about/journey">Journey</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="services">Services</a>
                                        <ul class="sub-menu">
                                            <li><a href="services/business-consulting">Business Consulting</a></li>
                                            <li><a href="services/it-solutions">IT Solutions</a></li>
                                            <li><a href="services/it-staffing">IT Staffing</a></li>
                                            <li><a href="services/digital-marketing">Digital Marketing</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="technologies">Technology</a>
                                        <ul class="sub-menu">
                                            <li><a href="technologies/app-development">App Development</a></li>
                                            <li><a href="technologies/data-integration">Data Integration</a></li>
                                            <li><a href="technologies/data-analytics-business-intelligence">Data Analytics & Business Intelligence</a></li>
                                            <li><a href="technologies/database-data-warehousing">Database & Data Warehousing</a></li>
                                            <li><a href="technologies/cloud-migration">Cloud Migration</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="contact">Contact</a></li>
                                     <li><a href="case-studies">Case Studies</a></li>
                                </ul>
                            </nav>
                            <button type="button" class="ot-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>
                        </div>
                        <div class="col-auto d-none d-xl-block">
                            <div class="header-button">
                                <div class="call-btn">
                                    <div class="icon-btn"><i class="fas fa-phone"></i></div>
                                    <div class="media-body">
                                        <span class="box-subtitle">Quick Call</span>
                                        <h4 class="box-title"><a href="tel:+919962597975">+91 99625 97975</a></h4>
                                    </div>
                                </div>
                                <a href="contact" class="ot-btn btn-sm">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if ($pageName ?? null): ?>
    <div class="breadcumb-wrapper" data-bg-src="assets/img/bg/breadcumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"><?= $pageName ?></h1>
                <ul class="breadcumb-menu">
                    <li><a href="">Home</a></li>
                    <li><?= $pageName ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
