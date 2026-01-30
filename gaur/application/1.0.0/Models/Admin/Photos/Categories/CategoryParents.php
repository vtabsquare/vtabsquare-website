<?php

declare(strict_types=1);

namespace App\Models\Admin\Photos\Categories;

use Gaur\Model;

class CategoryParents extends Model
{
    /**
     * Get parent id
     *
     * @param int[] $cids category id
     *
     * @return int[]
     */
    public function getPid(array $cids): array
    {
        $qry = 'SELECT `pid`
                FROM `' . $this->db->prefixTable('photos_category_parents') . '`
                WHERE `cid` IN (' . implode(',', $cids) . ')';

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? array_unique(array_column($rdata, 'pid')) : $rdata;
        $data  = array_map(fn ($v) => (int)$v, $data);

        return $data;
    }
}
