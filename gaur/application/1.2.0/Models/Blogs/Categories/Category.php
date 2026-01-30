<?php

declare(strict_types=1);

namespace App\Models\Blogs\Categories;

use App\Data\Blogs\Categories\CategorySchema;
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
                FROM `' . $this->db->prefixTable('blogs_categories') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new CategorySchema())->filter($rdata) : $rdata;

        return $data;
    }

    public function getBySlug(string $slug): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('blogs_categories') . '`
                WHERE `slug` = ' . $this->db->escape($slug);

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new CategorySchema())->filter($rdata) : $rdata;

        return $data;
    }
    
    

}
