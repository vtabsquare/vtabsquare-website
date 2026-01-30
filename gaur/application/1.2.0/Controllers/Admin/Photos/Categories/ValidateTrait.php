<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Photos\Categories;

use App\Models\Admin\Photos\Categories\Category;
use App\Models\Admin\Photos\Categories\CategoryParent;
use Gaur\HTTP\Input;

trait ValidateTrait
{
    /**
     * Get parent categories
     *
     * @param int $id category id
     *
     * @return array<array<string, int>>
     */
    protected function getParents(int $id): array
    {
        $category = new Category();
        $parents  = [];

        while (true) {
            $item = $category->get($id);

            if (!$item) {
                break;
            }

            $parents[] = [
                'pid' => $item['id'],
                'rid' => $item['pid']
            ];

            if (!$item['pid']) {
                break;
            }

            $id = $item['pid'];
        }

        return $parents;
    }

    /**
     * Validate user inputs
     *
     * @return bool
     */
    protected function validateInput(?string $slug = ''): bool
    {
        $rfields = [
            'title',
            'slug',
        ];

        foreach ($rfields as $field) {
            $this->finputs[$field] = Input::data($field);

            if ($this->finputs[$field] === '') {
                $this->errors[] = 'Please fill all required fields!';
                goto exitValidation;
            }
        }

        $this->finputs['pid'] = Input::data('pid');

        if (mb_strlen($this->finputs['title']) > 64) {
            $this->errors[] = 'Title must be less than 65 characters!';
            goto exitValidation;
        }

        if (preg_match('#[^a-zA-Z0-9_\-]#', $this->finputs['slug'])) {
            $this->errors[] = 'Invalid characters found in URL';
            goto exitValidation;
        } elseif (strlen($this->finputs['slug']) > 256) {
            $this->errors[] = 'URL must be less than 257 characters';
            goto exitValidation;
        } elseif ($slug !== $this->finputs['slug']
            && (new Category())->existsBySlug($this->finputs['slug'])
        ) {
            $this->errors[] = 'URL already in use';
            goto exitValidation;
        }

        exitValidation:
        return !$this->errors;
    }

    /**
     * Validate parent category
     *
     * @param int $id current category id
     *
     * @return bool
     */
    protected function validateParent(int $id = 0): bool
    {
        if ($this->finputs['pid'] !== ''
            && (!ctype_digit($this->finputs['pid'])
            || $this->finputs['pid'] < 1
            || (int)$this->finputs['pid'] === $id
            || !(new Category())->exists((int)$this->finputs['pid'])
            || in_array($id, $id ? (new CategoryParent())->getPid((int)$this->finputs['pid']) : [], true))
        ) {
            $this->errors[] = 'Parent selection does not appear to be valid!';
        }

        $this->finputs['pid'] = (int)$this->finputs['pid'];

        return !$this->errors;
    }
}
