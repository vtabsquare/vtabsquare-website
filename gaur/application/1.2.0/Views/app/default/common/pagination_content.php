<ul class="pagination">
    <?php if ($currentPage > 2): ?>
    <li class="page-item">
        <a class="page-link" href="<?= $paginationUrl ?>?page=1">Start</a>
    </li>
    <?php endif; ?>

    <?php if ($currentPage > 1): ?>
    <li class="page-item">
        <a class="page-link" href="<?= $paginationUrl ?>?page=<?= $currentPage - 1 ?>">Previous</a>
    </li>
    <?php endif; ?>

    <?php for ($i = $paginationStart; $i <= $paginationEnd; $i++): ?>
    <li class="page-item<?php if ($i === $currentPage): ?> active<?php endif; ?>">
        <a class="page-link" href="<?= $paginationUrl ?>?page=<?= $i ?>"><?= $i ?></a>
    </li>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPage): ?>
    <li class="page-item">
        <a class="page-link" href="<?= $paginationUrl ?>?page=<?= $currentPage + 1 ?>">Next</a>
    </li>
    <?php endif; ?>

    <?php if ($totalPage > $linksCount && ($currentPage + 1) < $totalPage): ?>
    <li class="page-item d-none d-sm-block">
        <a class="page-link" href="<?= $paginationUrl ?>?page=<?= $totalPage ?>">End</a>
    </li>
    <?php endif; ?>
</ul>
