<?php

$status = [
    'fas fa-times text-danger',
    'fas fa-check text-success'
];

foreach ($items as $item):
?>
<div class="g-tr" data-id="<?= $item['id'] ?>">
    <div class="g-td"><?= $item['id'] ?></div>
    <div class="g-td text-left"><?= hentities($item['title']) ?></div>
    <div class="g-td text-left">
        <?php if ($item['pid']): ?>
        <?= hentities(implode(' > ', $categories[$item['pid']])) ?>
        <?php endif; ?>
    </div>
    <div class="g-td">
        <button type="button" data-item="status" class="btn btn-link p-0 g-fw-900 <?= $status[$item['status']] ?>"></button>
    </div>
    <div class="g-td">
        <a href="admin/blogs/categories/edit/<?= $item['id'] ?>">
            <span class="fas fa-edit"></span>
        </a>
    </div>
</div>
<?php endforeach; ?>
