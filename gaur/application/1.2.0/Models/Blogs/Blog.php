<?php

declare(strict_types=1);

namespace App\Models\Blogs;

use App\Data\Blogs\BlogSchema;
use Gaur\Model;

class Blog extends Model
{
    /**
     * Get blog info
     *
     * @param int $id blog id
     *
     * @return mixed[]|null
     */
    public function get(int $id): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('blogs') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new BlogSchema())->filter($rdata) : $rdata;

        return $data;
    }

    public function getBySlug(string $slug): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('blogs') . '`
                WHERE `slug` = ' . $this->db->escape($slug);

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new BlogSchema())->filter($rdata) : $rdata;

        return $data;
    }
}
