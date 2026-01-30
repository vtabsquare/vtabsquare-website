<?php

declare(strict_types=1);

namespace App\Models\Services;

use App\Data\Services\ServiceSchema;
use Gaur\Model;

class Service extends Model
{
    /**
     * Get service info
     *
     * @param int $id service id
     *
     * @return mixed[]|null
     */
    public function get(int $id): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('services') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new ServiceSchema())->filter($rdata) : $rdata;

        return $data;
    }
}
