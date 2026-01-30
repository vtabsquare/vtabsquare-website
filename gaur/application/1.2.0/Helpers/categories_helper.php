<?php

declare(strict_types=1);

/**
 * Assemble categories list
 *
 * @param mixed[] $categories categories list
 *
 * @return mixed[]
 */
function assembleCategories(array $categories): array
{
    $cmap        = array_flip(array_column($categories, 'id'));
    $fcategories = [];

    foreach ($categories as $item) {
        $category = $item;
        $parents  = [];

        while (true) {
            $parents[] = $category;

            if (!$category['pid']
                || !isset($cmap[$category['pid']])
            ) {
                break;
            }

            $category = $categories[$cmap[$category['pid']]];
        }

        $fcategories[$item['id']] = array_reverse($parents);
    }

    return $fcategories;
}

/**
 * Get categories list
 *
 * @param int[]  $cids                 category ids
 * @param string $categoriesModel      categories class
 * @param string $categoryParentsModel category parents class
 *
 * @return string[][]
 */
function getCategories(
    array $cids,
    string $categoriesModel,
    string $categoryParentsModel
): array
{
    if (!$cids) {
        return [];
    }

    $pids = array_unique(
        array_merge(
            $cids,
            (new $categoryParentsModel())->getPid($cids)
        )
    );

    $categories  = [];
    $tcategories = assembleCategories(
        (new $categoriesModel())->get($pids)
    );

    foreach ($tcategories as $id => $item) {
        if (!in_array($id, $cids, true)) {
            continue;
        }

        $categories[$id] = array_column($item, 'title', 'id');
    }

    return $categories;
}
