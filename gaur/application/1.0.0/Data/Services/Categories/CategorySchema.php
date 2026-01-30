<?php

declare(strict_types=1);

namespace App\Data\Services\Categories;

use Gaur\Database\SchemaFilter;
use Gaur\Database\SchemaType;

class CategorySchema extends SchemaFilter
{
    /**
     * id
     *
     * @var array<string, mixed>
     */
    public array $id = [
        'null' => false,
        'type' => SchemaType::INT
    ];

    /**
     * title
     *
     * @var array<string, mixed>
     */
    public array $title = [
        'null' => false,
        'type' => SchemaType::VARCHAR
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
     * total
     *
     * @var array<string, mixed>
     */
    public array $total = [
        'null' => false,
        'type' => SchemaType::INT
    ];

    /**
     * status
     *
     * @var array<string, mixed>
     */
    public array $status = [
        'null' => false,
        'type' => SchemaType::TINYINT
    ];
}
