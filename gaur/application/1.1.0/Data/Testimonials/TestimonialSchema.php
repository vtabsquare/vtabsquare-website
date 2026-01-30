<?php

declare(strict_types=1);

namespace App\Data\Testimonials;

use Gaur\Database\SchemaFilter;
use Gaur\Database\SchemaType;

class TestimonialSchema extends SchemaFilter
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
     * image
     *
     * @var array<string, mixed>
     */
    public array $image = [
        'null' => false,
        'type' => SchemaType::VARCHAR
    ];

    /**
     * message
     *
     * @var array<string, mixed>
     */
    public array $message = [
        'null' => false,
        'type' => SchemaType::VARCHAR
    ];

    /**
     * rating
     *
     * @var array<string, mixed>
     */
    public array $rating = [
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
