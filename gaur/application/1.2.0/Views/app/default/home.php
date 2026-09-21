<?= view('app/default/common/head_top') ?>

    <title><?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <meta name="description" content="VTAB Square develops AI applications, data analytics solutions and enterprise data migration services. Explore our technology capabilities and discuss your project.">
    <link rel="canonical" href="<?= config('Config\App')->baseURL ?>">
    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>

    <style>
        .preloader {display:none !important;}
        @media (max-width: 991px) {
            .c-partner {
                width: 200px;
                display: block;
                margin: 25px auto 0;
                position: relative;
            }
        }
        @media (min-width: 992px) {
            .c-partner {
                width: 150px;
                position: absolute;
                top: 0;
                left: 25px;
                z-index: 9;
            }
        }

        .c-partner-overlay {
            position: absolute;
            top: 10%;
            left: 10%;
            height: 80%;
            width: 80%;
            border-radius: 50%;
            background: #fff;
            z-index: -1;
        }

        .hero-1 .hero-img img {
            animation: none;
            border-radius: 0;
        }

        .hero-1 .hero-img::before, .hero-1 .hero-img::after {
            display: none;
        }
        .dot-list li p{
            margin-bottom: 0;
            margin-top: 0;
            font-size: 16px;
        }
    </style>

    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu') ?>

    <div class="owl-carousel owl-theme j-slide">
        <?php foreach ($slides as $item): ?>
        <?php
            $image = $item['image'];
            $textExists = $item['title'] || $item['heading1'] || $item['heading2'] || $item['desc'];
        ?>
        <?php if (!$textExists && !$image): continue; endif; ?>
        <div>
            <div class="ot-hero-wrapper hero-1">
                <div class="hero-circle"></div>
                <div class="hero-shape1"></div>
                <div class="hero-inner">
                    <div class="container">
                        <div class="hero-style1">
                            <span
                                class="sub-title"
                                <?php if (!$image): ?>
                                style="text-align: center;"
                                <?php endif; ?>
                            >
                                <span class="text"><?= hentities($item['title']) ?></span>
                            </span>
                            <h2
                                class="hero-title"
                                <?php if ($image): ?> style="width: 600px;max-width: 100%;"<?php endif; ?>
                            >
                                <span
                                    class="title1"
                                    <?php if (!$image): ?>
                                    style="max-width: unset;text-align: center;"
                                    <?php endif; ?>
                                >
                                    <?= hentities($item['heading1']) ?>
                                </span>
                                <span
                                    class="title2"
                                    <?php if (!$image): ?>
                                    style="max-width: unset;text-align: center;"
                                    <?php endif; ?>
                                >
                                    <?= hentities($item['heading2']) ?>
                                </span>
                            </h2>
                            <p
                                class="hero-text"
                                <?php if (!$image): ?>
                                style="max-width: unset;text-align: center;"
                                <?php endif; ?>
                            >
                                <?= hentities($item['desc']) ?>
                            </p>
                            <div
                                class="btn-group"
                                <?php if (!$image): ?>
                                style="display: flex;"
                                <?php endif; ?>
                            >
                                <?php if ($item['link1']): ?>
                                <a href="<?= hentities($item['link1']) ?>" class="ot-btn">Discover More</a>
                                <?php endif; ?>

                                <?php if ($item['link2']): ?>
                                <a href="<?= hentities($item['link2']) ?>" target="_blank" class="watch-btn">
                                    <div class="play-btn"><i class="fas fa-play"></i></div>
                                    <span class="text">Watch Video</span>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($image): ?>
                    <div class="hero-img">
                        <img src="images/home/slides/<?= $image ?>" alt="VTAB Square" />
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="about-sec1" id="about-sec">
        <div class="container space">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="title-area mb-15">
                        <span class="sub-title"><span class="text">Who We Are</span></span>
                        <h2 class="sec-title">Smart IT Services & Business Consulting for Growing Enterprises</h2>
                        <p class="sec-text">
                            At VTAB Square, we help businesses thrive with tailored IT solutions and strategic business consulting. Since 2019, our team—led by experts with 18+ years of experience has been delivering scalable, secure, and future-ready digital solutions.
                        </p>
                        <p>From improving data quality and cybersecurity to streamlining operations and driving growth, we partner with startups and established enterprises to unlock real business value.</p>
                        <p><b>Our Expertise:</b></p>
                    </div>
                    <div class="dot-list">
                        <ul>
                            <li><p>End-to-End IT Services & Digital Transformation</p></li>
                            <li><p>Customized Business Consulting Solutions</p></li>
                            <li><p>Proven Focus on Security, Efficiency, and Innovation</p></li>
                        </ul>
                        <p class="mt-15"><b>Your success is our mission—partner with VTAB Square for smarter solutions and lasting results.</b></p>
                    </div>
                    <div class="mt-15"><a href="https://vtabsquare.com/about" class="ot-btn">Discover More</a></div>
                </div>
                <div class="col-xl-6 col-lg-6 position-relative">
                    <div class="c-partner">
                        <img src="images/home/ms.png" alt="VTAB Square" class="img-fluid">
                        <div class="c-partner-overlay"></div>
                    </div>

                    <div class="img-box1">
                        <div class="img1"><img src="assets/img/normal/about_1_1.jpg"  alt="VTAB Square" /></div>
                        <div class="img2"><img src="assets/img/normal/about_1_2.jpg"  alt="VTAB Square" /></div>
                        <div class="shape1 jump-reverse"><img src="assets/img/normal/about_1_3.png"  alt="VTAB Square" /></div>
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="service-sec1" id="service-sec" data-bg-src="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-7 col-md-8">
                    <div class="title-area text-center">
                        <span class="sub-title"><span class="text">Our services</span></span>
                        <h2 class="sec-title">Services We Provide</h2>
                        <p class="sec-text">At Vtab Square, We Deliver Comprehensive Management Consulting Solutions Tailored To Your Unique Business Objectives. Our Services Span Across Strategy, Technology, Digital Transformation, Advanced Analytics, And Sustainability. We Don’t Just Advise—We Act As Your Strategic Partner, Working From The Inside Out To Identify Inefficiencies And Implement Transformative Solutions.</p>
                    </div>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-xl-4 col-md-4">
                    <img src="images/home/services/1.jpg" alt="VTAB Square" />
                    <div class="service-card p-3">
                        <h3 class="box-title"><a href="services/business-consulting">Business Consulting</a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden;">
                            Business consulting helps organizations improve performance by analyzing existing processes and developing plans for growth, efficiency, and profitability. Consultants provide expert advice on strategy, operations, finance, and more to solve complex business problems.
                        </p>
                        <a href="services/business-consulting" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <img src="images/home/services/2.jpg" alt="VTAB Square" />
                    <div class="service-card p-3">
                        <h3 class="box-title"><a href="services/it-solutions">IT Solutions</a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden;">
                            IT solutions involve designing, implementing, and managing technology systems to meet business needs. This includes software development, network infrastructure, cybersecurity, data analytics, and more, to enhance efficiency, productivity, and innovation.
                        </p>
                        <a href="services/it-solutions" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <img src="images/home/services/3.jpg" alt="VTAB Square" />
                    <div class="service-card p-3">
                        <h3 class="box-title"><a href="services/it-staffing">IT Staffing</a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden;">
                            IT staffing provides temporary or permanent IT professionals to organizations, filling gaps in expertise or capacity. This includes sourcing, recruiting, and managing talent for roles such as software development, cybersecurity, data science, and more.
                        </p>
                        <a href="services/it-staffing" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space" data-bg-src="assets/img/bg/cta_bg_1.jpg">
        <div class="container">
            <div class="row gy-30 align-items-center justify-content-center justify-content-md-between">
                <div class="col-xl-6 col-md-6 align-items-center">
                    <div class="title-area mb-0 text-center">
                        <span class="sub-title text-white">We are here to answer your questions 24/7</span>
                        <h2 class="sec-title text-white">Need A Consultation?</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 text-center"><a href="https://vtabsquare.com/contact" class="ot-btn style3">Let’s Get Started</a></div>
            </div>
        </div>
    </section>
    <div class="space">
        <div class="shape-mockup spin" data-top="40%" data-left="4%"><img src="assets/img/shape/shape_1.png"  alt="VTAB Square" /></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 text-center text-lg-start">
                    <div class="pe-xxl-5">
                        <div class="title-area">
                            <span class="sub-title"><span class="text">How We Work</span></span>
                            <h2 class="sec-title">Driving Results with Strategy, Technology, and Precision</h2>
                            <p>
                                At VTAB Square, our work is guided by a clear process that blends industry expertise, client collaboration, and technology-driven execution. We don’t just deliver services—we create tailored solutions that solve
                                real business challenges.
                            </p>
                            <p><b>Discovery & Consultation : </b> We begin by understanding your goals, challenges, and business landscape to craft a customized strategy.</p>
                            <p><b>Strategic Planning : </b> Our experts design a roadmap with scalable, efficient solutions aligned with your vision and business needs.</p>
                            <p><b>Execution with Precision : </b> Using the latest technologies and best practices, we implement the plan with a focus on quality and timely delivery.</p>
                            <p><b>Review & Optimization : </b> We monitor progress, analyze performance, and refine processes continuously to ensure long-term success.</p>
                        </div>
                        <!-- <div class="btn-group">
                            <a href="contact" class="ot-btn">contact us</a>
                            <div class="call-text">
                                <h4 class="box-title">Call Us: +91 099625 97975</h4>
                                <span class="box-text">For any question</span>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="text-center mt-40 mt-lg-0"><img src="assets/img/normal/vector_1.png" alt="VTAB Square" /></div>
                </div>
            </div>
        </div>
    </div>

    <section class="space" data-bg-src="assets/img/bg/cta_bg_1.jpg">
        <div class="container">
            <div class="row gy-30 align-items-center justify-content-center justify-content-md-between">
                <div class="col-xl-6 col-md-6 align-items-center">
                    <div class="title-area mb-0 text-center">
                        <span class="sub-title text-white">For any questions, Contact Us</span>
                        <h2 class="sec-title text-white">Call Us: <a class="text-white" href="tel:+91 099625 97975">+91 99625 97975</a></h2>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 text-center"><a href="contact" class="ot-btn style3">Contact Us</a></div>
            </div>
        </div>
    </section>

    <div class="space">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title"><span class="text">Brands We Work With</span></span>
                <h2 class="sec-title">Who Trusts VTAB Square for IT & Consulting Excellence</h2>
            </div>
            <div class="brand-grid-wrap">
                <?php foreach ($clients as $v): ?>
                <div class="brand-grid">
                    <img src="images/clients/<?= $v ?>" alt="VTAB Square" />
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <section class="space" id="testi-sec" data-bg-src="assets/img/bg/testi_bg_1.jpg">
        <div class="container">
            <div class="title-area">
                <span class="sub-title text-white"><span class="text">Client Testimonials</span></span>
                <h2 class="sec-title text-white">About Customer Stories</h2>
            </div>
            <div
                class="swiper ot-slider has-shadow"
                id="testiSlider1"
                data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}}'
            >
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $item): ?>
                    <div class="swiper-slide">
                        <div class="testi-card">
                            <p class="box-text"><?= hentities($item['message']) ?></p>
                            <div class="box-profile">
                                <?php if ($item['image']): ?>
                                <div class="box-img">
                                    <img src="images/testimonials/<?= $item['image'] ?>" alt="<?= hentities($item['name']) ?>" />
                                </div>
                                <?php endif; ?>
                                <div class="media-body">
                                    <h3 class="box-title"><?= hentities($item['name']) ?></h3>
                                    <span class="box-desig" style="color: #ffc107;">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                        <?php if ($i < $item['rating']): ?>
                                        <i class="fas fa-star"></i>
                                        <?php else: ?>
                                        <i class="far fa-star"></i>
                                        <?php endif; ?>
                                        <?php endfor; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-pagination"></div>
            </div>
        </div>
    </section>
    <?php /* <section class="space">
        <div class="container z-index-common">
            <div class="title-area text-center">
                <span class="sub-title"><span class="text">Team Members</span></span>
                <h2 class="sec-title">Our Top Skilled Experts</h2>
            </div>
            <div
                class="swiper ot-slider has-shadow"
                id="teamSlider1"
                data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'
            >
                <div class="swiper-wrapper">
                    <?php foreach ($teams as $item): ?>
                    <div class="swiper-slide">
                        <div class="ot-team team-card">
                            <?php if ($item['image']): ?>
                            <div class="box-img">
                                <img src="images/teams/<?= $item['image'] ?>" alt />
                            </div>
                            <?php endif; ?>
                            <div class="box-content">
                                <h3 class="box-title"><?= hentities($item['name']) ?></h3>
                                <span class="box-desig"><?= hentities($item['designation']) ?></span>
                                <?php if ($item['links']): ?>
                                <div class="ot-social">
                                    <?php if ($item['links']['facebook']): ?>
                                    <a target="_blank" href="<?= hentities($item['links']['facebook']) ?>"><i class="fab fa-facebook-f"></i></a>
                                    <?php endif; ?>

                                    <?php if ($item['links']['twitter']): ?>
                                    <a target="_blank" href="<?= hentities($item['links']['twitter']) ?>"><i class="fab fa-twitter"></i></a>
                                    <?php endif; ?>

                                    <?php if ($item['links']['instagram']): ?>
                                    <a target="_blank" href="<?= hentities($item['links']['instagram']) ?>"><i class="fab fa-instagram"></i></a>
                                    <?php endif; ?>

                                    <?php if ($item['links']['linkedin']): ?>
                                    <a target="_blank" href="<?= hentities($item['links']['linkedin']) ?>"><i class="fab fa-linkedin-in"></i></a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section> */ ?>
    <div>
        <div class="container">
            <div class="counter-card-wrap">
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_1.svg" alt="VTAB Square" /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['experience']) ?></span>+</h2>
                        <span class="box-text">Years of Industry Experience</span>
                    </div>
                </div>
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_2.svg" alt="VTAB Square" /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['projects']) ?></span>+</h2>
                        <span class="box-text">Completed projects</span>
                    </div>
                </div>
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_3.svg" alt="VTAB Square" /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['experts']) ?></span>+</h2>
                        <span class="box-text">SKILLED EXPERTS</span>
                    </div>
                </div>
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_4.svg" alt="VTAB Square" /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['clients']) ?></span>+</h2>
                        <span class="box-text">HAPPY CLIENTS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="overflow-hidden space">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-end">
                <div class="col-lg">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title"><span class="text">Case Studies</span></span>
                        <h2 class="sec-title">Our Successful Projects</h2>
                    </div>
                </div>
                <div class="col-lg-auto d-none d-lg-block">
                    <div class="sec-btn">
                        <div class="icon-box">
                            <button data-slider-prev="#gallerySlider1" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>
                            <button data-slider-next="#gallerySlider1" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div
                class="swiper ot-slider has-shadow"
                id="gallerySlider1"
                data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"},"1400":{"slidesPerView":"4"}}}'
            >
                <div class="swiper-wrapper">
                    <?php foreach ($casestudy as $item): ?>
                    <div class="swiper-slide">
                        <div class="gallery-card style2">
                            <?php if ($item['image']): ?>
                            <div class="box-img">
                                <img src="images/casestudies/thumb/<?= $item['image'] ?>" alt="<?= hentities($item['title']) ?>" />
                                <a href="case-studies/<?= hentities($item['slug']) ?>" class="icon-btn"><i class="far fa-link"></i></a>
                            </div>
                            <?php endif; ?>
                            <div class="box-content">
                                <h3 class="box-title"><a href="case-studies/<?= hentities($item['slug']) ?>"><?= hentities($item['title']) ?></a></h3>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="d-block d-lg-none mt-40 text-center">
                <div class="icon-box">
                    <button data-slider-prev="#gallerySlider1" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>
                    <button data-slider-next="#gallerySlider1" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    <section class="cta-sec2 pt-5" data-bg-src="assets/img/bg/cta_bg_2.jpg">
        <div class="container">
            <div class="row gy-30 align-items-center">
                <div class="col-lg-6 text-center text-lg-start space-bottom">
                    <div class="title-area mb-37">
                        <span class="sub-title"><span class="text">Why Choose VTAB Square?</span></span>
                        <h2 class="sec-title">Trusted <span class="text-theme">IT & Consulting </span>Partner in India</h2>
                        <p class="sec-text">
                            At VTAB Square, we deliver more than just IT solutions – we empower businesses to thrive in an ever-evolving digital landscape. Here’s why our clients trust us to drive transformation, growth, and efficiency:
                        </p>
                        <p>
                            <b>Expertise in IT & Business Transformation : </b>With over 18 years of industry experience, VTAB Square offers deep expertise in delivering cutting-edge IT solutions, consulting, and digital transformation
                            strategies. Our team helps businesses unlock their potential and drive sustainable growth.
                        </p>
                        <p>
                            <b>Tailored Solutions for Every Industry : </b>We specialize in creating customized solutions designed to meet the unique challenges of each industry whether you're in healthcare, logistics, banking, or education.
                            Our approach is flexible and adaptable to your specific needs.
                        </p>
                        <p>
                            <b>Proven Track Record of Success : </b>Trusted by over 100 businesses, we have a history of delivering successful projects with precision and excellence. Our high client retention rate and numerous successful case
                            studies speak volumes about the results we deliver.
                        </p>
                        <p>
                            <b>Commitment to Quality, Innovation, and Results : </b>At VTAB Square, we don’t just focus on technology—we focus on delivering tangible results. Our solutions are designed to improve operational efficiency, enhance
                            data-driven decision-making, and ensure long-term value for our clients.
                        </p>
                    </div>
                    <a href="https://tawk.to/chat/60b4da4e6699c7280da9e059/1f7179hjt" class="ot-btn style4">Take Support</a>
                </div>
                <div class="col-lg-6">
                    <div class="img-box2"><img src="assets/img/normal/cta_1.png" alt="VTAB Square" /></div>
                </div>
            </div>
        </div>
        <div class="cta-texts">
            <span class="text">Fast 24/7 Customer Service</span>
            <div class="line"></div>
            <span class="text">Save time & valuable money</span>
        </div>
    </section>
    <section class="overflow-hidden space" id="blog-sec">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title"><span class="text">News Posts</span></span>
                <h2 class="sec-title">Latest Blog Updates</h2>
            </div>
            <div class="owl-carousel owl-theme j-blogs">
                <?php foreach ($blogs as $item): ?>
                <div>
                    <div class="blog-box">
                        <?php if ($item['image']): ?>
                        <div class="blog-img"><img src="images/blogs/thumb/<?= $item['image'] ?>" alt="<?= hentities($item['title']) ?>" /></div>
                        <?php endif; ?>
                        <div class="blog-content">
                            <h3 class="box-title"><a href="blog/<?= hentities($item['slug']) ?>"><?= hentities($item['title']) ?></a></h3>
                            <p class="box-text" style="height: 4.5em; overflow: hidden"><?= implode(' ', array_slice(explode(' ', strip_tags($item['info'])), 0, 100)) ?></p>
                            <a href="blog/<?= hentities($item['slug']) ?>" class="ot-btn btn-sm">Read More</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?= view('app/default/common/foot_top') ?>

    <script>
    (() => {
        "use strict";

        let $;

        function initCarousel1() {
            $(".j-slide").owlCarousel({
                loop: true,
                nav: false,
                navText: ["◂", "▸"],
                dots: false,
                autoplay: true,
                autoplayTimeout: 20000,
                autoplaySpeed: 10000,
                autoplayHoverPause: false,
                items: 1,
                animateOut: "slideOutUp",
                animateIn: "slideInUp"
            });
        }

        function initCarousel2() {
            $(".j-blogs").owlCarousel({
                loop: true,
                nav: false,
                navText: ["◂", "▸"],
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: false,
                margin: 20,
                responsive: {
                    0: {
                        items: 1
                    },
                    992: {
                        items: 3
                    }
                }
            });
        }

        function init() {
            $ = jQuery;
            initCarousel1();
            initCarousel2();
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>

    <script type="text/x-async-css" data-src="https://cdn.jsdelivr.net/gh/animate-css/animate.css@3.7.2/animate.min.css" data-integrity="sha384-7/Tl0k65OTvDSvtuq7aPR7aa0aCz7ZKqHsbMRLxhzueldW+9MZpCe9LB1c5UBuNS" class="j-acss"></script>
    <script type="text/x-async-css" data-src="https://cdn.jsdelivr.net/gh/OwlCarousel2/OwlCarousel2@2.3.4/dist/assets/owl.carousel.min.css" data-integrity="sha384-kcNNzf7wI8//ZkNUaDd5JwxLoFaBgkj9Z4O4NwtuX9Lkmsz0HoITOxJsGkYxDuyG" class="j-acss"></script>
    <script type="text/x-async-css" data-src="https://cdn.jsdelivr.net/gh/OwlCarousel2/OwlCarousel2@2.3.4/dist/assets/owl.theme.default.min.css" data-integrity="sha384-8/AzSKHReNfZT4HGFTyRyJ1jXhhx/ZMnmX08Cy6TeaKWj0Vzho0AabG06C8mh02i" class="j-acss"></script>
    <script type="text/x-async-js" data-src="https://cdn.jsdelivr.net/gh/OwlCarousel2/OwlCarousel2@2.3.4/dist/owl.carousel.min.js" data-integrity="sha384-l/y5WJTphApmSlx76Ev6k4G3zxu/+19CVvn9OTKI7gs4Yu5Hm8mjpdtdr5oyhnNo" class="j-ajs"></script>

    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
