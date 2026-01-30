    <?= view('app/default/common/head_top') ?>

    <title>About - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => 'About us']) ?>

    <div class="space" id="about-sec">
        <div class="shape-mockup jump d-none d-sm-block" data-bottom="20%" data-right="8%"><img src="assets/img/shape/shape_2.png" alt /></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-35 mb-lg-0">
                    <div class="img-box6">
                        <div class="img1"><img src="assets/img/normal/about_4_1.jpg" alt /></div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 text-center text-lg-start">
                    <div class="ps-xl-5">
                        <div class="title-area mb-37">
                            <span class="sub-title"><span class="text">About VTAB SQUARE</span></span>
                            <h2 class="sec-title">Empowering Businesses Through Innovation & Excellence</h2>
                            <p class="sec-text">At VTAB SQUARE, we are a dynamic and emerging IT and services provider, dedicated to delivering excellence in data quality, security, and business solutions. Backed by over 18 years of our founder’s industry experience, we have been operating since 2019 with a mission to drive business transformation. Our services are designed to enhance operational efficiency and streamline processes, enabling sustainable growth and measurable results for our clients.</p>
                            <p><b>"Vision Without Action Is Merely A Dream. Action Without Vision Simply Passes The Time. But Vision Combined With Action Can Change The World."</b></p>
                            <p>At Vtab Square, This Belief Drives Our Approach To Delivering Value And Excellence.</p>
                            <p>We Focus On:</p>
                            <p>•	Gaining A Deep Understanding Of Our Clients’ Objectives</p>
                            <p>•	Developing Strategic, Results-Driven Plans</p>
                            <p>•	Fostering Clear And Consistent Communication</p>
                            <p>•	Executing With Precision And Purpose</p>
                            <p>•	Continuously Monitoring And Refining For Optimal Outcomes</p>
                            <p>
                                 Our Commitment Is To Consistently Exceed Customer Expectations In Quality, Delivery, And Cost—Through A Relentless Focus On Continuous Improvement And Meaningful Customer Engagement.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <section class="space">
        <div class="container z-index-common">
            <div class="title-area text-center">
                <span class="sub-title"><span class="text">VTAB SQUARE</span></span>
                <h2 class="sec-title">Our Mission and Vision</h2>
            </div>
           <p><b> Our Mission</b></p>
           <p>Our mission is to consistently exceed customer expectations by delivering exceptional quality, timely solutions, and cost-effective services. We are committed to continuous improvement and fostering meaningful client engagement to ensure sustained success and satisfaction.</p>
           <p><b> Our Vision</b></p>
           <p>Our vision is to create lasting value and make a meaningful difference empowering businesses through innovation, excellence, and purpose-driven solutions.</p>
        </div>
         
    </section>


    <?= view('app/default/common/foot_top') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>