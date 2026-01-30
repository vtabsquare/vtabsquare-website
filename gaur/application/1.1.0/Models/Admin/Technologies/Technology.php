<?php

declare(strict_types=1);

namespace App\Models\Admin\Technologies;

use App\Data\Technologies\TechnologySchema;
use Gaur\Model;

class Technology extends Model
{
    /**
     * Add technology
     *
     * @param mixed[] $rdata technology information
     *
     * @return void
     */
    public function add(array $rdata): void
    {
        $data = (new TechnologySchema())->filter($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('technologies') . '`(`title`, `cid`, `image`, `video`, `info`, `mdesc`, `mkeywords`, `status`, `date_added`)
                VALUES ('
                    . $this->db->escape($data['title'])
                    . ', ' . $this->db->escape($data['cid'])
                    . ', ' . $this->db->escape($data['image'])
                    . ', ' . $this->db->escape($data['video'])
                    . ', ' . $this->db->escape($data['info'])
                    . ', ' . $this->db->escape($data['mdesc'])
                    . ', ' . $this->db->escape($data['mkeywords'])
                    . ', 1'
                    . ', ' . $this->db->escape(date('Y-m-d H:i:s'))
                . ')';

        $this->db->query($qry);
    }

    /**
     * Update technology status
     *
     * @param int $id technology id
     *
     * @return void
     */
    public function changeStatus(int $id): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('technologies') . '`
                SET `status` = NOT `status`
                WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Technology existence check
     *
     * @param int $id technology id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('technologies') . '`
                WHERE `id` = ' . $id;

        return (bool)$this->db->query($qry)->getRowArray();
    }

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

    /**
     * Get category id
     *
     * @param int $id technology id
     *
     * @return int
     */
    public function getCid(int $id): int
    {
        $qry = 'SELECT `cid`
                FROM `' . $this->db->prefixTable('technologies') . '`
                WHERE `id` = ' . $id;

        return (int)($this->db->query($qry)->getRowArray()['cid'] ?? 0);
    }

    /**
     * Get technology image
     *
     * @param int $id technology id
     *
     * @return string
     */
    public function getImage(int $id): string
    {
        $qry = 'SELECT `image`
                FROM `' . $this->db->prefixTable('technologies') . '`
                WHERE `id` = ' . $id;

        return $this->db->query($qry)->getRowArray()['image'] ?? '';
    }

    /**
     * Update technology info
     *
     * @param int     $id    technology id
     * @param mixed[] $rdata technology information
     *
     * @return void
     */
    public function update(int $id, array $rdata): void
    {
        $data = (new TechnologySchema())->filter($rdata);

        $qry = 'UPDATE `' . $this->db->prefixTable('technologies') . '`
                SET `title` = ' . $this->db->escape($data['title'])
                    . ', `cid` = ' . $this->db->escape($data['cid'])
                    . ', `image` = ' . $this->db->escape($data['image'])
                    . ', `video` = ' . $this->db->escape($data['video'])
                    . ', `info` = ' . $this->db->escape($data['info'])
                    . ', `mdesc` = ' . $this->db->escape($data['mdesc'])
                    . ', `mkeywords` = ' . $this->db->escape($data['mkeywords'])
                    . ', `date_modified` = ' . $this->db->escape(date('Y-m-d H:i:s'))
                . ' WHERE `id` = ' . $id;

        $this->db->query($qry);
    }
}
