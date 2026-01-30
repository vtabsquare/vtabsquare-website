<?php

declare(strict_types=1);

namespace App\Models\Technologies;

use App\Data\Technologies\TechnologySchema;
use Gaur\Model;

class Technologies extends Model
{
    /**
     * Get technologies list
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
                    `id`, `title`, `cid`, `image`, `info`, `date_added`
                FROM `' . $this->db->prefixTable('technologies') . '`
                WHERE `status` = 1';

        if ($cid) {
            $qry .= ' AND `cid` = ' . $cid;
        }

        $qry .= ' ORDER BY `id` ASC';
        $qry .= ' LIMIT ' . ($offset ? ($offset . ', ') : '') . $limit;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new TechnologySchema())->filterBatch($rdata) : $rdata;

        return $data;
    }
}
