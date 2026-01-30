<?php

declare(strict_types=1);

namespace App\Models\Photos;

use App\Data\Photos\PhotoSchema;
use Gaur\Model;

class Photos extends Model
{
    /**
     * Get photos list
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
                    `id`, `title`, `slug`, `cid`, `images`, `info`, `date_added`
                FROM `' . $this->db->prefixTable('photos') . '`
                WHERE `status` = 1';

        if ($cid) {
            $qry .= ' AND `cid` = ' . $cid;
        }

        $qry .= ' ORDER BY `id` DESC';
        $qry .= ' LIMIT ' . ($offset ? ($offset . ', ') : '') . $limit;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new PhotoSchema())->filterBatch($rdata) : $rdata;

        return $data;
    }
}
