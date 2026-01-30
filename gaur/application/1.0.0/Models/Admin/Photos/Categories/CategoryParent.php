<?php

declare(strict_types=1);

namespace App\Models\Admin\Photos\Categories;

use App\Data\Photos\Categories\CategoryParentSchema;
use Gaur\Model;

class CategoryParent extends Model
{
    /**
     * Add category parent
     *
     * @param int                       $cid   category id
     * @param array<array<string, int>> $rdata parent information
     *
     * @return void
     */
    public function add(int $cid, array $rdata): void
    {
        $data = (new CategoryParentSchema())->filterBatch($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('photos_category_parents') . '`(`cid`, `pid`, `rid`)
                VALUES ';

        foreach ($data as $item) {
            $qry .= '('
                    . $cid
                    . ', ' . $item['pid']
                    . ', ' . $item['rid']
                . '),';
        }

        $qry = substr($qry, 0, -1);

        $this->db->query($qry);
    }

    /**
     * Get category id
     *
     * @param int $pid parent id
     *
     * @return int[]
     */
    public function getCid(int $pid): array
    {
        $qry = 'SELECT `cid`
                FROM `' . $this->db->prefixTable('photos_category_parents') . '`
                WHERE `pid` = ' . $pid;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? array_column($rdata, 'cid') : $rdata;
        $data  = array_map(fn ($v) => (int)$v, $data);

        return $data;
    }

    /**
     * Get parent id
     *
     * @param int $cid category id
     *
     * @return int[]
     */
    public function getPid(int $cid): array
    {
        $qry = 'SELECT `pid`
                FROM `' . $this->db->prefixTable('photos_category_parents') . '`
                WHERE `cid` = ' . $cid;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? array_column($rdata, 'pid') : $rdata;
        $data  = array_map(fn ($v) => (int)$v, $data);

        return $data;
    }

    /**
     * Remove category parent
     *
     * @param int $cid category id
     *
     * @return void
     */
    public function remove(int $cid): void
    {
        $qry = 'DELETE FROM `' . $this->db->prefixTable('photos_category_parents') . '`
                WHERE `cid` = ' . $cid;

        $this->db->query($qry);
    }
}
