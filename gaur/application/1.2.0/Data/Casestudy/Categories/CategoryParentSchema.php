<?php

declare(strict_types=1);

namespace App\Data\Casestudy\Categories;

use Gaur\Database\SchemaFilter;
use Gaur\Database\SchemaType;

class CategoryParentSchema extends SchemaFilter
{
    /**
     * category id
     *
     * @var array<string, mixed>
     */
    public array $cid = [
        'null' => false,
        'type' => SchemaType::INT
    ];

    /**
     * parent id
     *
     * @var array<string, mixed>
     */
    public array $pid = [
        'null' => false,
        'type' => SchemaType::INT
    ];

    /**
     * root id
     *
     * @var array<string, mixed>
     */
    public array $rid = [
        'null' => false,
        'type' => SchemaType::INT
    ];
}
