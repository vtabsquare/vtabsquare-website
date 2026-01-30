<?php

declare(strict_types=1);

namespace App\Data\Teams;

use Gaur\Database\SchemaFilter;
use Gaur\Database\SchemaType;

class TeamSchema extends SchemaFilter
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
     * name
     *
     * @var array<string, mixed>
     */
    public array $name = [
        'null' => false,
        'type' => SchemaType::VARCHAR
    ];

    /**
     * designation
     *
     * @var array<string, mixed>
     */
    public array $designation = [
        'null' => false,
        'type' => SchemaType::VARCHAR
    ];

    /**
     * links
     *
     * @var array<string, mixed>
     */
    public array $links = [
        'null' => false,
        'type' => SchemaType::JSON
    ];

    /**
     * image
     *
     * @var array<string, mixed>
     */
    public array $image = [
        'null' => false,
        'type' => SchemaType::VARCHAR
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

    /**
     * date added
     *
     * @var array<string, mixed>
     */
    public array $date_added = [
        'null' => false,
        'type' => SchemaType::DATETIME
    ];
}
