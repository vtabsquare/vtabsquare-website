<?php

declare(strict_types=1);

namespace App\Models\Admin\Photos;

use App\Data\Photos\PhotoSchema;
use Gaur\Model;

class Photo extends Model
{
    /**
     * Add photo
     *
     * @param mixed[] $rdata photo information
     *
     * @return void
     */
    public function add(array $rdata): void
    {
        $data = (new PhotoSchema())->filter($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('photos') . '`(`title`, `cid`, `images`, `info`, `mdesc`, `mkeywords`, `status`, `date_added`)
                VALUES ('
                    . $this->db->escape($data['title'])
                    . ', ' . $this->db->escape($data['cid'])
                    . ', ' . $this->db->escape($data['images'])
                    . ', ' . $this->db->escape($data['info'])
                    . ', ' . $this->db->escape($data['mdesc'])
                    . ', ' . $this->db->escape($data['mkeywords'])
                    . ', 1'
                    . ', ' . $this->db->escape(date('Y-m-d H:i:s'))
                . ')';

        $this->db->query($qry);
    }

    /**
     * Update photo status
     *
     * @param int $id photo id
     *
     * @return void
     */
    public function changeStatus(int $id): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('photos') . '`
                SET `status` = NOT `status`
                WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Photo existence check
     *
     * @param int $id photo id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('photos') . '`
                WHERE `id` = ' . $id;

        return (bool)$this->db->query($qry)->getRowArray();
    }

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

    /**
     * Get category id
     *
     * @param int $id photo id
     *
     * @return int
     */
    public function getCid(int $id): int
    {
        $qry = 'SELECT `cid`
                FROM `' . $this->db->prefixTable('photos') . '`
                WHERE `id` = ' . $id;

        return (int)($this->db->query($qry)->getRowArray()['cid'] ?? 0);
    }

    /**
     * Get photo images
     *
     * @param int $id photo id
     *
     * @return string[]
     */
    public function getImages(int $id): array
    {
        $qry = 'SELECT `images`
                FROM `' . $this->db->prefixTable('photos') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new PhotoSchema())->filter($rdata) : $rdata;

        return $data['images'] ?? [];
    }

    /**
     * Update photo info
     *
     * @param int     $id    photo id
     * @param mixed[] $rdata photo information
     *
     * @return void
     */
    public function update(int $id, array $rdata): void
    {
        $data = (new PhotoSchema())->filter($rdata);

        $qry = 'UPDATE `' . $this->db->prefixTable('photos') . '`
                SET `title` = ' . $this->db->escape($data['title'])
                    . ', `cid` = ' . $this->db->escape($data['cid'])
                    . ', `images` = ' . $this->db->escape($data['images'])
                    . ', `info` = ' . $this->db->escape($data['info'])
                    . ', `mdesc` = ' . $this->db->escape($data['mdesc'])
                    . ', `mkeywords` = ' . $this->db->escape($data['mkeywords'])
                    . ', `date_modified` = ' . $this->db->escape(date('Y-m-d H:i:s'))
                . ' WHERE `id` = ' . $id;

        $this->db->query($qry);
    }
}
