<?php

declare(strict_types=1);

namespace App\Models\Admin\Teams;

use App\Data\Teams\TeamSchema;
use Gaur\Model;

class Team extends Model
{
    /**
     * Add team
     *
     * @param mixed[] $rdata team information
     *
     * @return void
     */
    public function add(array $rdata): void
    {
        $data = (new TeamSchema())->filter($rdata);

        $qry = 'INSERT INTO `' . $this->db->prefixTable('teams') . '`(`name`, `designation`, `links`, `image`, `status`, `date_added`)
                VALUES ('
                    . $this->db->escape($data['name'])
                    . ', ' . $this->db->escape($data['designation'])
                    . ', ' . $this->db->escape($data['links'])
                    . ', ' . $this->db->escape($data['image'])
                    . ', 1'
                    . ', ' . $this->db->escape(date('Y-m-d H:i:s'))
                . ')';

        $this->db->query($qry);
    }

    /**
     * Update team status
     *
     * @param int $id team id
     *
     * @return void
     */
    public function changeStatus(int $id): void
    {
        $qry = 'UPDATE `' . $this->db->prefixTable('teams') . '`
                SET `status` = NOT `status`
                WHERE `id` = ' . $id;

        $this->db->query($qry);
    }

    /**
     * Team existence check
     *
     * @param int $id team id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        $qry = 'SELECT `id`
                FROM `' . $this->db->prefixTable('teams') . '`
                WHERE `id` = ' . $id;

        return (bool)$this->db->query($qry)->getRowArray();
    }

    /**
     * Get team info
     *
     * @param int $id team id
     *
     * @return mixed[]|null
     */
    public function get(int $id): ?array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('teams') . '`
                WHERE `id` = ' . $id;

        $rdata = $this->db->query($qry)->getRowArray();
        $data  = $rdata ? (new TeamSchema())->filter($rdata) : $rdata;

        return $data;
    }

    /**
     * Get team image
     *
     * @param int $id team id
     *
     * @return string
     */
    public function getImage(int $id): string
    {
        $qry = 'SELECT `image`
                FROM `' . $this->db->prefixTable('teams') . '`
                WHERE `id` = ' . $id;

        return $this->db->query($qry)->getRowArray()['image'] ?? '';
    }

    /**
     * Update team info
     *
     * @param int     $id    team id
     * @param mixed[] $rdata team information
     *
     * @return void
     */
    public function update(int $id, array $rdata): void
    {
        $data = (new TeamSchema())->filter($rdata);

        $qry = 'UPDATE `' . $this->db->prefixTable('teams') . '`
                SET `name` = ' . $this->db->escape($data['name'])
                    . ', `designation` = ' . $this->db->escape($data['designation'])
                    . ', `links` = ' . $this->db->escape($data['links'])
                    . ', `image` = ' . $this->db->escape($data['image'])
                . ' WHERE `id` = ' . $id;

        $this->db->query($qry);
    }
}
