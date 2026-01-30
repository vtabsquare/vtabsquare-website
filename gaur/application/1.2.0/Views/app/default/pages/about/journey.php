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
                <h2 class="h4">Our Journey at VTAB Square</h2>
                <p>At VTAB Square, we’ve grown with a clear purpose driven by innovation, built on experience, and guided by a vision to empower businesses through technology and strategy.</p>
                
                <h3 class="h6 mb-0">2017 – Strategic Consulting</h3>
                <p>Laid the foundation by providing expert consultation to startups, enabling them to scale with structured planning and digital adoption.</p>

                <h3 class="h6 mb-0">2019 – Incorporation of VTAB Square Pvt Ltd</h3>
                <p>Our vision formalized as we launched VTAB Square to deliver end-to-end IT and business solutions with a strong client-first approach.</p>

                <h3 class="h6 mb-0">2020 – Operational Excellence</h3>
                <p>Commenced full-scale services, delivering quality-driven solutions across industries and focusing on measurable outcomes and continuous innovation.</p>

                <h3 class="h6 mb-0">2023 - Microsoft Partner Recognition</h3>
                <p>Achieved Microsoft Partner status, reinforcing our capability in enterprise solutions and cloud ecosystems.</p>

                <h3 class="h6 mb-0">2025 - Scaling to 50+ Employees</h3>
                <p>Expanded into a 50+ member team, strengthening delivery capacity and diversifying into advanced Gen AI, BI, and cloud solutions.</p>
            </div>
        </div>
    </div>

    <?= view('app/default/common/foot_top') ?>
    <?= view('app/default/common/js') ?>
    <?= view('app/default/common/foot_bottom') ?>