<?php

declare(strict_types=1);

namespace App\Models\Admin\Testimonials;

use App\Data\Testimonials\TestimonialSchema;
use Gaur\Model;

class Testimonial extends Model
{
    /**
     * Add testimonial
     *
     * @param mixed[] $rdata testimonial information
     *
     * @return void
     */
    public function add(array $rdata): void
    {
        $data = (new TestimonialSchema())->filter($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('testimonials') . '`(`name`, `image`, `message`, `rating`, `status`, `date_added`)
                VALUES ('
                    . $this->db->escape($data['name'])
                    . ', ' . $this->db->escape($data['image'])
                    . ', ' . $this->db->escape($data['message'])
                    . ', ' . $this->db->escape($data['rating'])
                    . ', 1'
                    . ', ' . $this->db->escape(date('Y-m-d H:i:s'))
                . ')';

        $this->db->query($qry);
    }

    /**
     * Update testimonial status
     *
     * @param int $id testimonial id
     *
     * @return void
     */
    public function changeStatus(int $id): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('testimonials') . '`
                SET `status` = NOT `status`
                WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Testimonial existence check
     *
     * @param int $id testimonial id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('testimonials') . '`
                WHERE `id` = ' . $id;

        return (bool)$this->db->query($qry)->getRowArray();
    }

    /**
     * Get testimonial info
     *
     * @param int $id testimonial id
     *
     * @return mixed[]|null
     */
    public function get(int $id): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('testimonials') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new TestimonialSchema())->filter($rdata) : $rdata;

        return $data;
    }

    /**
     * Get testimonial image
     *
     * @param int $id testimonial id
     *
     * @return string
     */
    public function getImage(int $id): string
    {
        $qry = 'SELECT `image`
                FROM `' . $this->db->prefixTable('testimonials') . '`
                WHERE `id` = ' . $id;

        return $this->db->query($qry)->getRowArray()['image'] ?? '';
    }

    /**
     * Update testimonial info
     *
     * @param int     $id    testimonial id
     * @param mixed[] $rdata testimonial information
     *
     * @return void
     */
    public function update(int $id, array $rdata): void
    {
        $data = (new TestimonialSchema())->filter($rdata);

        $qry = 'UPDATE `' . $this->db->prefixTable('testimonials') . '`
                SET `name` = ' . $this->db->escape($data['name'])
                    . ', `image` = ' . $this->db->escape($data['image'])
                    . ', `message` = ' . $this->db->escape($data['message'])
                    . ', `rating` = ' . $this->db->escape($data['rating'])
                . ' WHERE `id` = ' . $id;

        $this->db->query($qry);
    }
}
