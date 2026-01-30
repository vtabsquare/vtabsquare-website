    <?php $dateAdded = strtotime($service['date_added']); ?>
    <?php $dateModified = $service['date_modified'] ? strtotime($service['date_modified']) : 0; ?>

    <!-- meta for facebook -->
    <meta property="og:title" content="<?= hentities($service['title']) ?>">

    <?php if ($service['mdesc']): ?>
    <meta property="og:description" content="<?= hentities($service['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($service['image']): ?>
    <meta property="og:image" content="<?= config('Config\App')->baseURL ?>images/services/<?= $service['image'] ?>">
    <?php endif; ?>

    <meta property="og:url" content="<?= config('Config\App')->baseURL ?>services/item/<?= $service['id'] ?>">
    <meta property="og:site_name" content="<?= config('Config\App')->siteName ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?= date('c', $dateAdded) ?>">

    <?php if ($service['date_modified']): ?>
    <meta property="article:modified_time" content="<?= date('c', $dateModified) ?>">
    <?php endif; ?>

    <meta property="article:section" content="<?= hentities($category['title']) ?>">

    <!-- meta for twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= hentities($service['title']) ?>">

    <?php if ($service['mdesc']): ?>
    <meta name="twitter:description" content="<?= hentities($service['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($service['image']): ?>
    <meta name="twitter:image" content="<?= config('Config\App')->baseURL ?>images/services/<?= $service['image'] ?>">
    <?php endif; ?>

    <!-- meta for google -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?= config('Config\App')->baseURL ?>services/item/<?= $service['id'] ?>"
        },
        "headline": "<?= hentities($service['title']) ?>",

        <?php if ($service['image']): ?>
        "image": "<?= config('Config\App')->baseURL ?>images/services/<?= $service['image'] ?>",
        <?php endif; ?>

        "datePublished": "<?= date('c', $dateAdded) ?>",

        <?php if ($service['date_modified']): ?>
        "dateModified": "<?= date('c', $dateModified) ?>",
        <?php endif; ?>

        "author": {
            "@type": "Person",
            "name": "<?= config('Config\App')->siteName ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?= config('Config\App')->siteName ?>",
            "logo": {
                "@type": "ImageObject",
                "url": ""
            }
        }
    }
    </script>
