    <?php $dateAdded = strtotime($technology['date_added']); ?>
    <?php $dateModified = $technology['date_modified'] ? strtotime($technology['date_modified']) : 0; ?>

    <!-- meta for facebook -->
    <meta property="og:title" content="<?= hentities($technology['title']) ?>">

    <?php if ($technology['mdesc']): ?>
    <meta property="og:description" content="<?= hentities($technology['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($technology['image']): ?>
    <meta property="og:image" content="<?= config('Config\App')->baseURL ?>images/technologies/<?= $technology['image'] ?>">
    <?php endif; ?>

    <meta property="og:url" content="<?= config('Config\App')->baseURL ?>technologies/item/<?= $technology['id'] ?>">
    <meta property="og:site_name" content="<?= config('Config\App')->siteName ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?= date('c', $dateAdded) ?>">

    <?php if ($technology['date_modified']): ?>
    <meta property="article:modified_time" content="<?= date('c', $dateModified) ?>">
    <?php endif; ?>

    <meta property="article:section" content="<?= hentities($category['title']) ?>">

    <!-- meta for twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= hentities($technology['title']) ?>">

    <?php if ($technology['mdesc']): ?>
    <meta name="twitter:description" content="<?= hentities($technology['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($technology['image']): ?>
    <meta name="twitter:image" content="<?= config('Config\App')->baseURL ?>images/technologies/<?= $technology['image'] ?>">
    <?php endif; ?>

    <!-- meta for google -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?= config('Config\App')->baseURL ?>technologies/item/<?= $technology['id'] ?>"
        },
        "headline": "<?= hentities($technology['title']) ?>",

        <?php if ($technology['image']): ?>
        "image": "<?= config('Config\App')->baseURL ?>images/technologies/<?= $technology['image'] ?>",
        <?php endif; ?>

        "datePublished": "<?= date('c', $dateAdded) ?>",

        <?php if ($technology['date_modified']): ?>
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
