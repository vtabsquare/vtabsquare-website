    <?php $dateAdded = strtotime($casestudy['date_added']); ?>
    <?php $dateModified = $casestudy['date_modified'] ? strtotime($casestudy['date_modified']) : 0; ?>

    <!-- meta for facebook -->
    <meta property="og:title" content="<?= hentities($casestudy['title']) ?>">

    <?php if ($casestudy['mdesc']): ?>
    <meta property="og:description" content="<?= hentities($casestudy['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($casestudy['image']): ?>
    <meta property="og:image" content="<?= config('Config\App')->baseURL ?>images/casestudies/<?= $casestudy['image'] ?>">
    <?php endif; ?>

    <meta property="og:url" content="<?= config('Config\App')->baseURL ?>case-studies/<?= hentities($casestudy['slug']) ?>">
    <meta property="og:site_name" content="<?= config('Config\App')->siteName ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?= date('c', $dateAdded) ?>">

    <?php if ($casestudy['date_modified']): ?>
    <meta property="article:modified_time" content="<?= date('c', $dateModified) ?>">
    <?php endif; ?>

    <meta property="article:section" content="<?= hentities($casestudy['title']) ?>">

    <!-- meta for twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= hentities($casestudy['title']) ?>">

    <?php if ($casestudy['mdesc']): ?>
    <meta name="twitter:description" content="<?= hentities($casestudy['mdesc']) ?>">
    <?php endif; ?>

    <?php if ($casestudy['image']): ?>
    <meta name="twitter:image" content="<?= config('Config\App')->baseURL ?>images/casestudies/<?= $casestudy['image'] ?>">
    <?php endif; ?>

    <!-- meta for google -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?= config('Config\App')->baseURL ?>case-studies/<?= hentities($casestudy['slug']) ?>"
        },
        "headline": "<?= hentities($casestudy['title']) ?>",

        <?php if ($casestudy['image']): ?>
        "image": "<?= config('Config\App')->baseURL ?>images/casestudies/<?= $casestudy['image'] ?>",
        <?php endif; ?>

        "datePublished": "<?= date('c', $dateAdded) ?>",

        <?php if ($casestudy['date_modified']): ?>
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
