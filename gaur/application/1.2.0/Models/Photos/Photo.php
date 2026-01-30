<?php

declare(strict_types=1);

namespace App\Models\Photos;

use App\Data\Photos\PhotoSchema;
use Gaur\Model;

class Photo extends Model
{
    /**
     * Get photo info
     *
     * @param int $id photo id
     *
     * @return mixed[]|null
     */
    public function get(int $id): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('photos') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new PhotoSchema())->filter($rdata) : $rdata;

        return $data;
    }

    public function getBySlug(string $slug): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('photos') . '`
                WHERE `slug` = ' . $this->db->escape($slug);

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new PhotoSchema())->filter($rdata) : $rdata;

        return $data;
    }
}
