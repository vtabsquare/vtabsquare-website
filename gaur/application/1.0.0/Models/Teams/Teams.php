<?php

declare(strict_types=1);

namespace App\Models\Teams;

use App\Data\Teams\TeamSchema;
use Gaur\Model;

class Teams extends Model
{
    public function get(): array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('teams') . '`
                WHERE `status` = 1';

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new TeamSchema())->filterBatch($rdata) : $rdata;

        return $data;
    }
}
