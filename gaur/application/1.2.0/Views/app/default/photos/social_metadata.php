    <?php $dateAdded = strtotime($photo['date_added']); ?>
    <?php $dateModified = $photo['date_modified'] ? strtotime($photo['date_modified']) : 0; ?>

    <!-- meta for facebook -->
    <meta property="og:title" content="<?= hentities($photo['title']) ?>">

    <?php if ($photo['mdesc']): ?>
    <meta property="og:description" content="<?= hentities($photo['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($photo['images']): ?>
    <meta property="og:image" content="<?= config('Config\App')->baseURL ?>images/photos/<?= $photo['images'][0] ?>">
    <?php endif; ?>

    <meta property="og:url" content="<?= config('Config\App')->baseURL ?>photo/<?= hentities($photo['slug']) ?>">
    <meta property="og:site_name" content="<?= config('Config\App')->siteName ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?= date('c', $dateAdded) ?>">

    <?php if ($photo['date_modified']): ?>
    <meta property="article:modified_time" content="<?= date('c', $dateModified) ?>">
    <?php endif; ?>

    <meta property="article:section" content="<?= hentities($category['title']) ?>">

    <!-- meta for twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= hentities($photo['title']) ?>">

    <?php if ($photo['mdesc']): ?>
    <meta name="twitter:description" content="<?= hentities($photo['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($photo['images']): ?>
    <meta name="twitter:image" content="<?= config('Config\App')->baseURL ?>images/photos/<?= $photo['images'][0] ?>">
    <?php endif; ?>

    <!-- meta for google -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?= config('Config\App')->baseURL ?>photo/<?= hentities($photo['slug']) ?>"
        },
        "headline": "<?= hentities($photo['title']) ?>",

        <?php if ($photo['images']): ?>
        "image": "<?= config('Config\App')->baseURL ?>images/photos/<?= $photo['images'][0] ?>",
        <?php endif; ?>

        "datePublished": "<?= date('c', $dateAdded) ?>",

        <?php if ($photo['date_modified']): ?>
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
