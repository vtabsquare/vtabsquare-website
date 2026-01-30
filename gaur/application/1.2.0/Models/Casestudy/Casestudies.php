<?php

declare(strict_types=1);

namespace App\Models\Casestudy;

use App\Data\Casestudy\CasestudySchema;
// use App\Data\Services\ServiceSchema;
use Gaur\Model;

class Casestudies extends Model
{
    /**
     * Get services list
     *
     * @param int $cid    category id
     * @param int $limit  items limit
     * @param int $offset page offset
     *
     * @return mixed[][]
     */
    public function get(int $cid, int $limit, int $offset): array
    {
        $qry = 'SELECT
                    `id`, `title`, `slug`, `image`, `info`, `date_added`
                FROM `' . $this->db->prefixTable('casestudies') . '`
                WHERE `status` = 1';

        // if ($cid) {
        //     $qry .= ' AND `cid` = ' . $cid;
        // }

        $qry .= ' ORDER BY `id` ASC';
        $qry .= ' LIMIT ' . ($offset ? ($offset . ', ') : '') . $limit;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new CasestudySchema())->filterBatch($rdata) : $rdata;

        return $data;
    }

    public function total(int $id = 0): int
    {
        $qry = 'SELECT `total`
                FROM `' . $this->db->prefixTable('casestudies') . '`
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
