<?php

declare(strict_types=1);

namespace App\Data\Services;

use Gaur\Filters\Config;

class FilterConfig extends Config
{
    /**
     * Allowed filter fields
     *
     * @var array<string, string>
     */
    public array $filterFields = [
        'status' => 'Status'
    ];

    /**
     * Allowed filter values
     *
     * @var array<string, string[]>
     */
    public array $filterValues = [
        'status' => [
            'Disabled',
            'Enabled'
        ]
    ];

    /**
     * Allowed order fields
     *
     * @var array<string, string>
     */
    public array $orderFields = [
        'id' => 'ID'
    ];

    /**
     * Allowed search fields
     *
     * @var array<string, string>
     */
    public array $searchFields = [
        'id'    => 'ID',
        'title' => 'Title'
    ];
}
