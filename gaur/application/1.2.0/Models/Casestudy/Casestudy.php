<?php

declare(strict_types=1);

namespace App\Models\Casestudy;

use App\Data\Casestudy\CasestudySchema;
use Gaur\Model;

class Casestudy extends Model
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
                FROM `' . $this->db->prefixTable('casestudies') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new CasestudySchema())->filter($rdata) : $rdata;

        return $data;
    }

    public function getBySlug(string $slug): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('casestudies') . '`
                WHERE `slug` = ' . $this->db->escape($slug);

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new CasestudySchema())->filter($rdata) : $rdata;

        return $data;
    }
}
