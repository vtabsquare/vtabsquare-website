<?php

declare(strict_types=1);

namespace App\Models\Admin\Casestudy;

use App\Data\Casestudy\CasestudySchema;
use Gaur\Model;

class Casestudy extends Model
{
    /**
     * Add service
     *
     * @param mixed[] $rdata service information
     *
     * @return void
     */
    public function add(array $rdata): void
    {
        $data = (new CasestudySchema())->filter($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('casestudies') . '`(`title`, `slug`, `image`, `video`, `info`, `mdesc`, `mkeywords`, `status`, `date_added`)
                VALUES ('
                    . $this->db->escape($data['title'])
                    . ', ' . $this->db->escape($data['slug'])
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
     * Update service status
     *
     * @param int $id service id
     *
     * @return void
     */
    public function changeStatus(int $id): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('casestudies') . '`
                SET `status` = NOT `status`
                WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Service existence check
     *
     * @param int $id service id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('casestudies') . '`
                WHERE `id` = ' . $id;

        return (bool)$this->db->query($qry)->getRowArray();
    }

    public function existsBySlug($slug)
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('casestudies') . '`
                WHERE `slug` = ' . $this->db->escape($slug);

        return (bool)$this->db->query($qry)->getRowArray();
    }

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

    /**
     * Get category id
     *
     * @param int $id service id
     *
     * @return int
     */
    public function getCid(int $id): int
    {
        $qry = 'SELECT `cid`
                FROM `' . $this->db->prefixTable('casestudies') . '`
                WHERE `id` = ' . $id;

        return (int)($this->db->query($qry)->getRowArray()['cid'] ?? 0);
    }

    /**
     * Get service image
     *
     * @param int $id service id
     *
     * @return string
     */
    public function getImage(int $id): string
    {
        $qry = 'SELECT `image`
                FROM `' . $this->db->prefixTable('casestudies') . '`
                WHERE `id` = ' . $id;

        return $this->db->query($qry)->getRowArray()['image'] ?? '';
    }

    /**
     * Update service info
     *
     * @param int     $id    service id
     * @param mixed[] $rdata service information
     *
     * @return void
     */
    public function update(int $id, array $rdata): void
    {
        $data = (new CasestudySchema())->filter($rdata);

        $qry = 'UPDATE `' . $this->db->prefixTable('casestudies') . '`
                SET `title` = ' . $this->db->escape($data['title'])
                    . ', `slug` = ' . $this->db->escape($data['slug'])
                    // . ', `cid` = ' . $this->db->escape($data['cid'])
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
