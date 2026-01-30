<?php

declare(strict_types=1);

namespace App\Models\Technologies;

use App\Data\Technologies\TechnologySchema;
use Gaur\Model;

class Technology extends Model
{
    /**
     * Get technology info
     *
     * @param int $id technology id
     *
     * @return mixed[]|null
     */
    public function get(int $id): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('technologies') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new TechnologySchema())->filter($rdata) : $rdata;

        return $data;
    }
}
