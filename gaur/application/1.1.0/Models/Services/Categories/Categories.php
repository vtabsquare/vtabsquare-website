<?php

declare(strict_types=1);

namespace App\Models\Services\Categories;

use App\Data\Services\Categories\CategorySchema;
use Gaur\Model;

class Categories extends Model
{
    /**
     * Get categories list
     *
     * @param int[] $ids category id
     *
     * @return mixed[][]
     */
    public function get(array $ids): array
    {
        $qry = 'SELECT `id`, `title`, `pid`
                FROM `' . $this->db->prefixTable('services_categories') . '`
                WHERE `status` = 1
                    AND `id` IN (' . implode(',', $ids) . ')';

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new CategorySchema())->filterBatch($rdata) : $rdata;

        return $data;
    }

    /**
     * Get total
     *
     * @param int $id category id
     *
     * @return int
     */
    public function total(int $id = 0): int
    {
        $qry = 'SELECT `total`
                FROM `' . $this->db->prefixTable('services_categories') . '`
                WHERE `status` = 1';

        if ($id) {
            $qry .= ' AND `id` = ' . $id;
        }

        $total = array_sum(
            array_column(
                $this->db->query($qry)->getResultArray(),
                'total'
            )
        );

        return (int)$total;
    }
}
