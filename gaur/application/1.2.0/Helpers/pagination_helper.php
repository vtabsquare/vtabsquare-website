<?php

declare(strict_types=1);

/**
 * Create pagination
 *
 * @param int    $total         items total
 * @param int    $currentPage   current page
 * @param int    $listCount     list count
 * @param string $paginationUrl pagination url
 *
 * @return string
 */
function getPagination(
    int $total,
    int $currentPage,
    int $listCount,
    string $paginationUrl
): string
{
    if (!$total) {
        return '';
    }

    $totalPage = (int)ceil($total / $listCount);

    if ($currentPage < 1) {
        $currentPage = 1;
    }

    $paginationStart = $currentPage - 2;
    $linksCount      = 5;

    if ($paginationStart < 1) {
        $paginationStart = 1;
    }

    $paginationEnd = ($paginationStart + ($linksCount - 1));

    if ($paginationEnd > $totalPage) {
        $paginationStart -= $paginationEnd - $totalPage;

        if ($paginationStart < 1) {
            $paginationStart = 1;
        }

        $paginationEnd = $totalPage;
    }

    $data = [];

    $data['currentPage']     = $currentPage;
    $data['totalPage']       = $totalPage;
    $data['paginationStart'] = $paginationStart;
    $data['paginationEnd']   = $paginationEnd;
    $data['linksCount']      = $linksCount;
    $data['paginationUrl']   = $paginationUrl;

    $content = view(
        'app/default/common/pagination_content',
        $data
    );

    return $content;
}
