<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Images;

use Gaur\HTTP\Input;

trait ValidateTrait
{
    /**
     * Assemble user inputs
     *
     * @return void
     */
    protected function assembleInput(): void
    {
        $this->finputs['page']   = (int)$this->finputs['page'];
        $this->finputs['count']  = (int)$this->finputs['count'];
        $this->finputs['offset'] = 0;

        if ($this->finputs['page'] < 1) {
            $this->finputs['page'] = 1;
        }

        if ($this->finputs['count'] < 1) {
            $this->finputs['count'] = 1;
        }

        if ($this->finputs['count'] > 20) {
            $this->finputs['count'] = 20;
        }

        if ($this->finputs['page'] > 1) {
            $this->finputs['offset'] = ($this->finputs['page'] - 1) * $this->finputs['count'];
        }
    }

    /**
     * Validate path name
     *
     * @param string $name folder name
     *
     * @return bool
     */
    protected function validateName(string $name): bool
    {
        $this->finputs['name'] = $name;

        if (!ctype_alnum($this->finputs['name'])
            || !is_dir(FCPATH . 'images/' . $this->finputs['name'] . '/attach')
        ) {
            $this->errors[] = 'Path does not appear to be valid!';
        }

        return !$this->errors;
    }

    /**
     * Validate pagination
     *
     * @return bool
     */
    protected function validatePagination(): bool
    {
        $fields = [
            'page',
            'count'
        ];

        foreach ($fields as $field) {
            $this->finputs[$field] = Input::url($field);
        }

        if (!ctype_digit($this->finputs['page'])) {
            $this->errors[] = 'Page does not appear to be valid!';
            goto exitValidation;
        }

        if (!ctype_digit($this->finputs['count'])) {
            $this->errors[] = 'Count does not appear to be valid!';
            goto exitValidation;
        }

        exitValidation:
        return !$this->errors;
    }
}
