    <?php $dateAdded = strtotime($blog['date_added']); ?>
    <?php $dateModified = $blog['date_modified'] ? strtotime($blog['date_modified']) : 0; ?>

    <!-- meta for facebook -->
    <meta property="og:title" content="<?= hentities($blog['title']) ?>">

    <?php if ($blog['mdesc']): ?>
    <meta property="og:description" content="<?= hentities($blog['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($blog['image']): ?>
    <meta property="og:image" content="<?= config('Config\App')->baseURL ?>images/blogs/<?= $blog['image'] ?>">
    <?php endif; ?>

    <meta property="og:url" content="<?= config('Config\App')->baseURL ?>blogs/item/<?= $blog['id'] ?>">
    <meta property="og:site_name" content="<?= config('Config\App')->siteName ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?= date('c', $dateAdded) ?>">

    <?php if ($blog['date_modified']): ?>
    <meta property="article:modified_time" content="<?= date('c', $dateModified) ?>">
    <?php endif; ?>

    <meta property="article:section" content="<?= hentities($category['title']) ?>">

    <!-- meta for twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= hentities($blog['title']) ?>">

    <?php if ($blog['mdesc']): ?>
    <meta name="twitter:description" content="<?= hentities($blog['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($blog['image']): ?>
    <meta name="twitter:image" content="<?= config('Config\App')->baseURL ?>images/blogs/<?= $blog['image'] ?>">
    <?php endif; ?>

    <!-- meta for google -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?= config('Config\App')->baseURL ?>blogs/item/<?= $blog['id'] ?>"
        },
        "headline": "<?= hentities($blog['title']) ?>",

        <?php if ($blog['image']): ?>
        "image": "<?= config('Config\App')->baseURL ?>images/blogs/<?= $blog['image'] ?>",
        <?php endif; ?>

        "datePublished": "<?= date('c', $dateAdded) ?>",

        <?php if ($blog['date_modified']): ?>
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
