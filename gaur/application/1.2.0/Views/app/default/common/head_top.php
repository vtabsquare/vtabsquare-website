<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

  <link rel="icon" type="image/png" href="<?= config('Config\App')->baseURL ?>images/favicon.png" />

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-JF4TY57YHS"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-JF4TY57YHS');
  </script>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />

  <meta name="title" content="VTAB Square | Power BI Dashboards, Data Analytics & Digital Marketing Solutions">
  <meta name="description" content="VTAB Square empowers businesses with data-driven Power BI dashboards, advanced analytics, and performance-focused digital marketing. Trusted by top brands for scalable, tailored solutions.">
  <meta name="keywords" content="VTAB, Power BI dashboards, data analytics services, digital marketing agency, business intelligence solutions, marketing automation, SEO services, PPC advertising, HR analytics dashboard, marketing analytics, social media marketing, performance marketing, content marketing, VTAB Square, data visualization experts, custom dashboards, analytics consulting, BI reporting solutions, enterprise data strategy, marketing strategy services">
  <?= view('app/default/common/meta_tags') ?>

  <!-- Schema Markup (Dynamic or Default) -->
  <?php if (isset($schema_json)){ ?>
    <script type="application/ld+json">
      <?= $schema_json ?>
    </script>
  <?php } else { ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "VTAB Square",
      "url": "https://vtabsquare.com",
      "logo": "https://vtabsquare.com/assets/img/logo.png",
      "sameAs": [
        "https://www.linkedin.com/company/vtab-square",
        "https://www.facebook.com/profile.php?id=61577734643610"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+91-9962597975",
        "contactType": "Customer Support"
      }
    }
    </script>
  <?php } ?>

  <base href="<?= config('Config\App')->baseURL ?>">