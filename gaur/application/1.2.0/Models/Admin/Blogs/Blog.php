<?php

declare(strict_types=1);

namespace App\Models\Admin\Blogs;

use App\Data\Blogs\BlogSchema;
use Gaur\Model;

class Blog extends Model
{
    /**
     * Add blog
     *
     * @param mixed[] $rdata blog information
     *
     * @return void
     */
    public function add(array $rdata): void
    {
        $data = (new BlogSchema())->filter($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('blogs') . '`(`title`, `slug`, `cid`, `image`, `video`, `info`, `mdesc`, `mkeywords`, `status`, `date_added`)
                VALUES ('
                    . $this->db->escape($data['title'])
                    . ', ' . $this->db->escape($data['slug'])
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
     * Update blog status
     *
     * @param int $id blog id
     *
     * @return void
     */
    public function changeStatus(int $id): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('blogs') . '`
                SET `status` = NOT `status`
                WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Blog existence check
     *
     * @param int $id blog id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('blogs') . '`
                WHERE `id` = ' . $id;

        return (bool)$this->db->query($qry)->getRowArray();
    }

    public function existsBySlug($slug)
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('blogs') . '`
                WHERE `slug` = ' . $this->db->escape($slug);

        return (bool)$this->db->query($qry)->getRowArray();
    }

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

    /**
     * Get category id
     *
     * @param int $id blog id
     *
     * @return int
     */
    public function getCid(int $id): int
    {
        $qry = 'SELECT `cid`
                FROM `' . $this->db->prefixTable('blogs') . '`
                WHERE `id` = ' . $id;

        return (int)($this->db->query($qry)->getRowArray()['cid'] ?? 0);
    }

    /**
     * Get blog image
     *
     * @param int $id blog id
     *
     * @return string
     */
    public function getImage(int $id): string
    {
        $qry = 'SELECT `image`
                FROM `' . $this->db->prefixTable('blogs') . '`
                WHERE `id` = ' . $id;

        return $this->db->query($qry)->getRowArray()['image'] ?? '';
    }

    /**
     * Update blog info
     *
     * @param int     $id    blog id
     * @param mixed[] $rdata blog information
     *
     * @return void
     */
    public function update(int $id, array $rdata): void
    {
        $data = (new BlogSchema())->filter($rdata);

        $qry = 'UPDATE `' . $this->db->prefixTable('blogs') . '`
                SET `title` = ' . $this->db->escape($data['title'])
                    . ', `slug` = ' . $this->db->escape($data['slug'])
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
