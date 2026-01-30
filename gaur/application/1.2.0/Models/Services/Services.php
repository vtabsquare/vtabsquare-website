<?php

declare(strict_types=1);

namespace App\Models\Services;

use App\Data\Services\ServiceSchema;
use Gaur\Model;

class Services extends Model
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
                    `id`, `title`, `slug`, `cid`, `image`, `info`, `date_added`
                FROM `' . $this->db->prefixTable('services') . '`
                WHERE `status` = 1';

        if ($cid) {
            $qry .= ' AND `cid` = ' . $cid;
        }

        $qry .= ' ORDER BY `id` ASC';
        $qry .= ' LIMIT ' . ($offset ? ($offset . ', ') : '') . $limit;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new ServiceSchema())->filterBatch($rdata) : $rdata;

        return $data;
    }
}
