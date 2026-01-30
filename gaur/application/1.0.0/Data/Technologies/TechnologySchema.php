<?php

declare(strict_types=1);

namespace App\Data\Technologies;

use Gaur\Database\SchemaFilter;
use Gaur\Database\SchemaType;

class TechnologySchema extends SchemaFilter
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
     * category id
     *
     * @var array<string, mixed>
     */
    public array $cid = [
        'null' => false,
        'type' => SchemaType::INT
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
     * video
     *
     * @var array<string, mixed>
     */
    public array $video = [
        'null' => false,
        'type' => SchemaType::VARCHAR
    ];

    /**
     * info
     *
     * @var array<string, mixed>
     */
    public array $info = [
        'null' => false,
        'type' => SchemaType::TEXT
    ];

    /**
     * meta description
     *
     * @var array<string, mixed>
     */
    public array $mdesc = [
        'null' => false,
        'type' => SchemaType::VARCHAR
    ];

    /**
     * meta keywords
     *
     * @var array<string, mixed>
     */
    public array $mkeywords = [
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

    /**
     * date modified
     *
     * @var array<string, mixed>
     */
    public array $date_modified = [
        'null' => true,
        'type' => SchemaType::DATETIME
    ];
}
