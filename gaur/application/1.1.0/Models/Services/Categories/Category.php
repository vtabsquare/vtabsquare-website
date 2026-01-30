<?php

declare(strict_types=1);

namespace App\Models\Services\Categories;

use App\Data\Services\Categories\CategorySchema;
use Gaur\Model;

class Category extends Model
{
    /**
     * Get category info
     *
     * @param int $id category id
     *
     * @return mixed[]|null
     */
    public function get(int $id): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('services_categories') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new CategorySchema())->filter($rdata) : $rdata;

        return $data;
    }
}
