    <?= view('app/default/common/head_top') ?>

    <title><?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <link rel="canonical" href="<?= config('Config\App')->baseURL ?>">
    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>

    <style>
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
                width: 200px;
                position: absolute;
                top: 0;
                left: 0;
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

        .c-slide {
            background: transparent no-repeat 0 0 / cover;
        }

        .c-slide1 {
            position: relative;
        }

        .c-slide1::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.25);
        }

        .c-slide .hero-circle,
        .c-slide .hero-shape1 {
            display: none;
        }

        .c-slide .sub-title,
        .c-slide .hero-title,
        .c-slide .hero-text {
            color: #fff;
        }
    </style>

    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu') ?>

    <div class="owl-carousel owl-theme j-slide">
        <?php $image = ''; ?>
        <?php foreach ($slides as $item): ?>
        <?php if (!$item['desc'] && !$item['image']): continue; endif; ?>
        <?php

            $a = '';

            if ($item['image']) {
                $a.= ' c-slide';
            }

            if ($item['image'] && ($item['title'] || $item['heading1'] || $item['heading2'] || $item['desc'])) {
                $a.= ' c-slide1';
            }

        ?>
        <div>
            <div
                class="ot-hero-wrapper hero-1<?= $a ?>" id="hero"
                <?php if ($item['image']): ?>
                style="background-image: url(images/home/slides/<?= $item['image'] ?>);"
                <?php endif; ?>
            >
                <div class="hero-circle"></div>
                <div class="hero-shape1"></div>
                <div
                    class="hero-inner"
                    <?php if ($item['image']): ?>
                    style="min-height: 100vh"
                    <?php endif; ?>
                >
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
                            <h1
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
                            </h1>
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
                                <a href="<?= hentities($item['link2']) ?>" class="watch-btn popup-video">
                                    <div class="play-btn"><i class="fas fa-play"></i></div>
                                    <span class="text">Watch Video</span>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($image): ?>
                    <div class="hero-img">
                        <img src="images/home/slides/<?= $image ?>" alt />
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
                <div class="col-xl-5 col-lg-6">
                    <div class="title-area mb-37">
                        <span class="sub-title"><span class="text">About VTAB SQUARE</span></span>
                        <h2 class="sec-title">Expert IT Services & Business Consulting Solutions</h2>
                        <p class="sec-text">
                            At VTAB SQUARE, we are a dynamic and emerging IT and services provider, dedicated to delivering excellence in data quality, security, and business solutions. Backed by over 18 years of our founder’s industry
                            experience, we have been operating since 2019 with a mission to drive business transformation. Our services are designed to enhance operational efficiency and streamline processes, enabling sustainable growth and
                            measurable results for our clients.
                        </p>
                        <p><b>Vision Without Action Is Merely A Dream. Action Without Vision Simply Passes The Time. But Vision Combined With Action Can Change The World.</b></p>
                    </div>
                    <div class="dot-list">
                        <ul>
                            <li>Experienced Leadership</li>
                            <li>End-to-End IT Solutions & Business Consulting</li>
                            <li>Commitment to Quality & Security</li>
                        </ul>
                    </div>
                    <div class="mt-45"><a href="" class="ot-btn">Discover More</a></div>
                </div>
                <div class="col-xl-7 col-lg-6 position-relative">
                    <div class="c-partner">
                        <img alt="" src="images/home/ms.png" class="img-fluid">
                        <div class="c-partner-overlay"></div>
                    </div>

                    <div class="img-box1">
                        <div class="img1"><img src="assets/img/normal/about_1_1.jpg" alt /></div>
                        <div class="img2"><img src="assets/img/normal/about_1_2.jpg" alt /></div>
                        <div class="shape1 jump-reverse"><img src="assets/img/normal/about_1_3.png" alt /></div>
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="service-sec1" id="service-sec" data-bg-src="assets/img/bg/service_bg_1.png">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-7 col-md-8">
                    <div class="title-area text-center">
                        <span class="sub-title"><span class="text">Our services</span></span>
                        <h2 class="sec-title">Service We Provide</h2>
                        <p class="sec-text">At Vtab Square, We Deliver Comprehensive Management Consulting Solutions Tailored To Your Unique Business Objectives. Our Services Span Across Strategy, Technology, Digital Transformation, Advanced Analytics, And Sustainability. We Don’t Just Advise—We Act As Your Strategic Partner, Working From The Inside Out To Identify Inefficiencies And Implement Transformative Solutions.</p>
                    </div>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-xl-3 col-md-6">
                    <img src="images/home/services/1.jpg" alt="" />
                    <div class="service-card p-3">
                        <h3 class="box-title"><a href="services/category/1">Business Consulting</a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden;">
                            Business consulting helps organizations improve performance by analyzing existing processes and developing plans for growth, efficiency, and profitability. Consultants provide expert advice on strategy, operations, finance, and more to solve complex business problems.
                        </p>
                        <a href="services/category/1" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <img src="images/home/services/2.jpg" alt="" />
                    <div class="service-card p-3">
                        <h3 class="box-title"><a href="services/category/2">IT Solutions</a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden;">
                            IT solutions involve designing, implementing, and managing technology systems to meet business needs. This includes software development, network infrastructure, cybersecurity, data analytics, and more, to enhance efficiency, productivity, and innovation.
                        </p>
                        <a href="services/category/2" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <img src="images/home/services/3.jpg" alt="" />
                    <div class="service-card p-3">
                        <h3 class="box-title"><a href="services/category/5">IT Staffing</a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden;">
                            IT staffing provides temporary or permanent IT professionals to organizations, filling gaps in expertise or capacity. This includes sourcing, recruiting, and managing talent for roles such as software development, cybersecurity, data science, and more.
                        </p>
                        <a href="services/category/5" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <img src="images/home/services/4.jpg" alt="" />
                    <div class="service-card p-3">
                        <h3 class="box-title"><a href="services/category/6">Training</a></h3>
                        <p class="box-text" style="height: 4.5em; overflow: hidden;">
                            Training involves equipping individuals or teams with the skills and knowledge needed to perform specific tasks or roles. It enhances performance, productivity, and professional development through structured learning programs, workshops, or online courses.
                        </p>
                        <a href="services/category/6" class="box-btn"><i class="fas fa-arrow-up-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space" data-bg-src="assets/img/bg/cta_bg_1.jpg">
        <div class="container">
            <div class="row gy-30 align-items-center justify-content-center justify-content-md-between">
                <div class="col-md-auto">
                    <div class="title-area mb-0 text-center text-md-start">
                        <span class="sub-title text-white">We are here to answer your questions 24/7</span>
                        <h2 class="sec-title text-white">Need A Consultation?</h2>
                    </div>
                </div>
                <div class="col-md-auto text-center"><a href="" class="ot-btn style3">Let’s Get Started</a></div>
            </div>
        </div>
    </section>
    <div class="space">
        <div class="shape-mockup spin" data-top="40%" data-left="4%"><img src="assets/img/shape/shape_1.png" alt /></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 text-center text-lg-start">
                    <div class="pe-xxl-5">
                        <div class="title-area">
                            <span class="sub-title"><span class="text">How We Work</span></span>
                            <h2 class="sec-title">Driving Results with Strategy, Technology, and Precision</h2>
                            <p>
                                At VTAB SQUARE, our work is guided by a clear process that blends industry expertise, client collaboration, and technology-driven execution. We don’t just deliver services—we create tailored solutions that solve
                                real business challenges.
                            </p>
                            <p><b>Discovery & Consultation : </b> We begin by understanding your goals, challenges, and business landscape to craft a customized strategy.</p>
                            <p><b>Strategic Planning : </b> Our experts design a roadmap with scalable, efficient solutions aligned with your vision and business needs.</p>
                            <p><b>Execution with Precision : </b> Using the latest technologies and best practices, we implement the plan with a focus on quality and timely delivery.</p>
                            <p><b>Review & Optimization : </b> We monitor progress, analyze performance, and refine processes continuously to ensure long-term success.</p>
                        </div>
                        <div class="btn-group">
                            <a href="contact" class="ot-btn">contact us</a>
                            <div class="call-text">
                                <h4 class="box-title">Call Us: +91 099625 97975</h4>
                                <span class="box-text">For any question</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="text-center mt-40 mt-lg-0"><img src="assets/img/normal/vector_1.png" alt /></div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-bottom">
        <div class="container">
            <div class="title-area text-center">
                <span class="sub-title"><span class="text">Brand We Work With</span></span>
                <h2 class="sec-title">Who Trust VTAB SQUARE for IT & Consulting Excellence</h2>
            </div>
            <div class="brand-grid-wrap">
                <?php foreach ($clients as $v): ?>
                <div class="brand-grid">
                    <img src="images/clients/<?= $v ?>" alt />
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <section class="space" id="testi-sec" data-bg-src="assets/img/bg/testi_bg_1.jpg">
        <div class="container">
            <div class="title-area">
                <span class="sub-title text-white"><span class="text">Client Testimonial</span></span>
                <h2 class="sec-title text-white">About Customer Stories</h2>
            </div>
            <div
                class="swiper ot-slider has-shadow"
                id="testiSlider1"
                data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}}'
            >
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $item): ?>
                    <div class="swiper-slide">
                        <div class="testi-card">
                            <p class="box-text"><?= hentities($item['message']) ?></p>
                            <div class="box-profile">
                                <?php if ($item['image']): ?>
                                <div class="box-img">
                                    <img src="images/testimonials/<?= $item['image'] ?>" alt />
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
    <section class="space">
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
    </section>
    <div>
        <div class="container">
            <div class="counter-card-wrap">
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_1.svg" alt /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['experience']) ?></span>+</h2>
                        <span class="box-text">Years of Industry Experience</span>
                    </div>
                </div>
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_2.svg" alt /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['projects']) ?></span>+</h2>
                        <span class="box-text">Completed projects</span>
                    </div>
                </div>
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_3.svg" alt /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['experts']) ?></span>+</h2>
                        <span class="box-text">SKILLED EXPERTS</span>
                    </div>
                </div>
                <div class="counter-card">
                    <div class="box-icon"><img src="assets/img/icon/counter_1_4.svg" alt /></div>
                    <div class="media-body">
                        <h2 class="box-number"><span class="counter-number"><?= hentities($statistics['clients']) ?></span>+</h2>
                        <span class="box-text">HAPPY CLIENTS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-hidden space-bottom">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-end">
                <div class="col-lg">
                    <div class="title-area text-center text-lg-start">
                        <span class="sub-title"><span class="text">Quick Projects</span></span>
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
        <div>
            <div
                class="swiper ot-slider has-shadow"
                id="gallerySlider1"
                data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"},"1400":{"slidesPerView":"5"}}}'
            >
                <div class="swiper-wrapper">
                    <?php foreach ($photos as $item): ?>
                    <div class="swiper-slide">
                        <div class="gallery-card">
                            <?php if ($item['images']): ?>
                            <div class="box-img">
                                <img src="images/photos/thumb/<?= $item['images'][0] ?>" alt />
                                <a href="photos/item/<?= $item['id'] ?>" class="icon-btn"><i class="far fa-search"></i></a>
                            </div>
                            <?php endif; ?>
                            <div class="box-content">
                                <h3 class="box-title"><a href="photos/item/<?= $item['id'] ?>"><?= hentities($item['title']) ?></a></h3>
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
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="title-area mb-37">
                        <span class="sub-title"><span class="text">Why Choose VTAB SQUARE?</span></span>
                        <h2 class="sec-title">Trusted <span class="text-theme">IT & Consulting </span>Partner in India</h2>
                        <p class="sec-text">
                            At VTAB SQUARE, we deliver more than just IT solutions – we empower businesses to thrive in an ever-evolving digital landscape. Here’s why our clients trust us to drive transformation, growth, and efficiency:
                        </p>
                        <p>
                            <b>Expertise in IT & Business Transformation : </b>With over 18 years of industry experience, VTAB SQUARE offers deep expertise in delivering cutting-edge IT solutions, consulting, and digital transformation
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
                            <b>Commitment to Quality, Innovation, and Results : </b>At VTAB SQUARE, we don’t just focus on technology—we focus on delivering tangible results. Our solutions are designed to improve operational efficiency, enhance
                            data-driven decision-making, and ensure long-term value for our clients.
                        </p>
                    </div>
                    <a href="https://tawk.to/chat/60b4da4e6699c7280da9e059/1f7179hjt" class="ot-btn style4">Take Support</a>
                </div>
                <div class="col-lg-6">
                    <div class="img-box2"><img src="assets/img/normal/cta_1.png" alt /></div>
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
                        <div class="blog-img"><img src="images/blogs/thumb/<?= $item['image'] ?>" alt /></div>
                        <?php endif; ?>
                        <div class="blog-content">
                            <h3 class="box-title"><a href="blogs/item/<?= $item['id'] ?>"><?= hentities($item['title']) ?></a></h3>
                            <p class="box-text" style="height: 4.5em; overflow: hidden"><?= implode(' ', array_slice(explode(' ', strip_tags($item['info'])), 0, 100)) ?></p>
                            <a href="blogs/item/<?= $item['id'] ?>" class="ot-btn btn-sm">Read More</a>
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
                autoplayTimeout: 5000,
                autoplaySpeed: 2000,
                autoplayHoverPause: false,
                items: 1
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
                        items: 2
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

    <script type="text/x-async-css" data-src="https://cdn.jsdelivr.net/gh/OwlCarousel2/OwlCarousel2@2.3.4/dist/assets/owl.carousel.min.css" data-integrity="sha384-kcNNzf7wI8//ZkNUaDd5JwxLoFaBgkj9Z4O4NwtuX9Lkmsz0HoITOxJsGkYxDuyG" class="j-acss"></script>
    <script type="text/x-async-css" data-src="https://cdn.jsdelivr.net/gh/OwlCarousel2/OwlCarousel2@2.3.4/dist/assets/owl.theme.default.min.css" data-integrity="sha384-8/AzSKHReNfZT4HGFTyRyJ1jXhhx/ZMnmX08Cy6TeaKWj0Vzho0AabG06C8mh02i" class="j-acss"></script>
    <script type="text/x-async-js" data-src="https://cdn.jsdelivr.net/gh/OwlCarousel2/OwlCarousel2@2.3.4/dist/owl.carousel.min.js" data-integrity="sha384-l/y5WJTphApmSlx76Ev6k4G3zxu/+19CVvn9OTKI7gs4Yu5Hm8mjpdtdr5oyhnNo" class="j-ajs"></script>

    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>
