<?php

declare(strict_types=1);

namespace App\Models\Blogs;

use App\Data\Blogs\BlogSchema;
use Gaur\Model;

class Blogs extends Model
{
    /**
     * Get blogs list
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
                FROM `' . $this->db->prefixTable('blogs') . '`
                WHERE `status` = 1';

        if ($cid) {
            $qry .= ' AND `cid` = ' . $cid;
        }

        $qry .= ' ORDER BY `id` DESC';
        $qry .= ' LIMIT ' . ($offset ? ($offset . ', ') : '') . $limit;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new BlogSchema())->filterBatch($rdata) : $rdata;

        return $data;
    }
}
