    <?= view('app/default/common/head_top') ?>

    <title>Journey - <?= config('Config\App')->siteTitle ?></title>

    <!-- meta for search engines -->
    <meta name="robots" content="follow, index">

    <?= view('app/default/common/css') ?>
    <?= view('app/default/common/head_bottom') ?>
    <?= view('app/default/common/menu', ['pageName' => 'Journey']) ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h4">Our Journey: A Legacy of Innovation and Excellence</h2>
                <p>At VTAB SQUARE, we embarked on a journey of purpose and progress—driven by innovation, built on experience, and fueled by a vision to empower businesses through technology and strategy.</p>
                <h3 class="h6 mb-0">2007 – Vision & Idea</h3>
                <p>The spark was ignited—our founder envisioned creating impactful digital solutions to shape the future of businesses.</p>

                <h3 class="h6 mb-0">2010 – Embracing Technology</h3>
                <p>Began working with emerging technologies, exploring transformative trends and evolving digital capabilities.</p>

                <h3 class="h6 mb-0">2015 – Industry Experience</h3>
                <p>Gained hands-on experience by working across various industries, understanding diverse operational challenges and needs.</p>

                <h3 class="h6 mb-0">2016 – Process Implementation</h3>
                <p>Successfully executed projects with streamlined processes, focusing on efficiency and consistency in delivery.</p>

                <h3 class="h6 mb-0">2017 – Strategic Consulting</h3>
                <p>Provided expert consultation to startups, helping them scale through structured planning and digital adoption.</p>

                <h3 class="h6 mb-0">2019 – The Launch of VTAB SQUARE Pvt Ltd</h3>
                <p>Our vision formalized. VTAB SQUARE was founded to offer comprehensive IT and business solutions with a client-first mindset.</p>

                <h3 class="h6 mb-0">2020 – Operational Excellence</h3>
                <p>Officially began offering services—delivering quality-driven solutions to clients across industries with a focus on results and continuous innovation.</p>
            </div>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>