<?php

declare(strict_types=1);

namespace App\Models\Admin\Blogs\Categories;

use App\Data\Blogs\Categories\CategorySchema;
use Gaur\Model;

class Category extends Model
{
    /**
     * Add category
     *
     * @param mixed[] $rdata category information
     *
     * @return int
     */
    public function add(array $rdata): int
    {
        $data = (new CategorySchema())->filter($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('blogs_categories') . '`(`title`, `pid`, `total`, `status`)
                VALUES ('
                    . $this->db->escape($data['title'])
                    . ', ' . $this->db->escape($data['pid'])
                    . ', 0'
                    . ', 1'
                . ')';

        $this->db->query($qry);
        return $this->db->insertID();
    }

    /**
     * Update category status
     *
     * @param int $id category id
     *
     * @return void
     */
    public function changeStatus(int $id): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('blogs_categories') . '`
                SET `status` = NOT `status`
                WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Category existence check
     *
     * @param int $id category id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('blogs_categories') . '`
                WHERE `id` = ' . $id;

        return (bool)$this->db->query($qry)->getRowArray();
    }

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

    /**
     * Get parent id
     *
     * @param int $id category id
     *
     * @return int
     */
    public function getPid(int $id): int
    {
        $qry = 'SELECT `pid`
                FROM `' . $this->db->prefixTable('blogs_categories') . '`
                WHERE `id` = ' . $id;

        return (int)($this->db->query($qry)->getRowArray()['pid'] ?? 0);
    }

    /**
     * Update category info
     *
     * @param int     $id    category id
     * @param mixed[] $rdata category information
     *
     * @return void
     */
    public function update(int $id, array $rdata): void
    {
        $data = (new CategorySchema())->filter($rdata);

        $qry = 'UPDATE `' . $this->db->prefixTable('blogs_categories') . '`
                SET `title` = ' . $this->db->escape($data['title'])
                    . ', `pid` = ' . $this->db->escape($data['pid'])
                . ' WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Update category total
     *
     * @param int    $id     category id
     * @param string $action type of action
     *
     * @return void
     */
    public function updateTotal(int $id, string $action): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('blogs_categories') . '`
                SET `total` = `total` ' . $action . ' 1'
                . ' WHERE `id` = ' . $id;

        $this->db->query($qry);
    }
}
