<?php

declare(strict_types=1);

namespace App\Models\Testimonials;

use App\Data\Testimonials\TestimonialSchema;
use Gaur\Model;

class Testimonials extends Model
{
    public function get(): array
    {
        $qry = 'SELECT *
                FROM `' . $this->db->prefixTable('testimonials') . '`
                WHERE `status` = 1';

        $rdata = $this->db->query($qry)->getResultArray();
        $data  = $rdata ? (new TestimonialSchema())->filterBatch($rdata) : $rdata;

        return $data;
    }
}
