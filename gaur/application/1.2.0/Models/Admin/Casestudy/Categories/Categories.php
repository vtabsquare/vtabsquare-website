<?php

declare(strict_types=1);

namespace App\Models\Admin\Casestudy\Categories;

use App\Data\Casestudy\Categories\CategorySchema;
use Gaur\Model;

class Categories extends Model
{
    /**
     * Get categories list
     *
     * @param array<string, string[]>|null $filter filter
     * @param array<string, string[]>|null $search search
     * @param int                          $limit  item limit
     * @param int                          $offset page offset
     * @param string[]|null                $order  order by
     *
     * @return mixed[][]
     */
    public function filter(
        ?array $filter,
        ?array $search,
        int $limit,
        int $offset,
        ?array $order
    ): array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('casestudy_categories') . '`
                WHERE 1';

        if (isset($filter['by']) && isset($filter['val'])) {
            foreach ($filter['by'] as $k => $v) {
                $qry .= ' AND `' . $v . '` = ' . $this->db->escape($filter['val'][$k]);
            }
        }

        if (isset($search['by']) && isset($search['val'])) {
            foreach ($search['by'] as $k => $v) {
                $qry .= ' AND `' . $v . '` LIKE \'%' . $this->db->escapeLikeString($search['val'][$k]) . '%\'';
            }

            $qry .= ' ESCAPE \'!\'';
        }

        if ($order) {
            $qry .= ' ORDER BY `' . $order['order'] . '` ' . $order['sort'];
        }

        $qry .= ' LIMIT ' . ($offset ? ($offset . ', ') : '') . $limit;

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new CategorySchema())->filterBatch($rdata) : $rdata;

        return $data;
    }

    /**
     * Get total categories count
     *
     * @param array<string, string[]>|null $filter filter
     * @param array<string, string[]>|null $search search
     *
     * @return int
     */
    public function filterTotal(
        ?array $filter,
        ?array $search
    ): int
    {
        $qry = 'SELECT COUNT(*) AS `total`
                FROM `' . $this->db->prefixTable('casestudy_categories') . '`
                WHERE 1';

        if (isset($filter['by']) && isset($filter['val'])) {
            foreach ($filter['by'] as $k => $v) {
                $qry .= ' AND `' . $v . '` = ' . $this->db->escape($filter['val'][$k]);
            }
        }

        if (isset($search['by']) && isset($search['val'])) {
            foreach ($search['by'] as $k => $v) {
                $qry .= ' AND `' . $v . '` LIKE \'%' . $this->db->escapeLikeString($search['val'][$k]) . '%\'';
            }

            $qry .= ' ESCAPE \'!\'';
        }

        return (int)($this->db->query($qry)->getRowArray()['total'] ?? 0);
    }

    /**
     * Get categories list
     *
     * @param int[] $ids category id
     *
     * @return mixed[][]
     */
    public function get(array $ids = []): array
    {
        $qry = 'SELECT `id`, `title`, `pid`
                FROM `' . $this->db->prefixTable('casestudy_categories') . '`';

        if ($ids) {
            $qry .= ' WHERE `id` IN (' . implode(',', $ids) . ')';
        }

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new CategorySchema())->filterBatch($rdata) : $rdata;

        return $data;
    }
}
