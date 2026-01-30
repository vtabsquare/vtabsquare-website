<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Technologies\Categories;

use App\Models\Admin\Technologies\Categories\Category;
use App\Models\Admin\Technologies\Categories\CategoryParent;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\Security\CSRF;

class Edit extends Controller
{
    use APIControllerTrait;
    use ValidateTrait;

    /**
     * Default page for this controller
     *
     * @param string $id category id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id       = (int)$id;
        $category = (new Category())->get($id);

        if (!$category) {
            Response::pageNotFound();
            return;
        }

        $data = [];

        $data['category'] = $category;

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/technologies/categories/edit', $data);
    }

    /**
     * Submit form
     *
     * @param string $id category id
     *
     * @return void
     */
    protected function submit(string $id): void
    {
        $id       = (int)$id;
        $category = new Category();

        // Prevent invalid id
        if (!$category->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        if (!$this->validateInput()
            || !$this->validateParent($id)
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        $categoryParent = new CategoryParent();

        $previousPid = $category->getPid($id);

        $category->update($id, $this->finputs);

        if ($previousPid != $this->finputs['pid']) {
            $categoryParent->remove($id);

            if ($this->finputs['pid']) {
                $categoryParent->add(
                    $id,
                    $this->getParents((int)$this->finputs['pid'])
                );
            }

            $this->updateParents($id);
        }

        $message = 'Congratulations! category has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/technologies/categories'
                ]
            ]
        );
    }

    /**
     * Update category parents
     *
     * @param int $cid category id
     *
     * @return void
     */
    protected function updateParents(int $cid): void
    {
        $category       = new Category();
        $categoryParent = new CategoryParent();

        $cids = $categoryParent->getCid($cid);

        foreach ($cids as $id) {
            $item = $category->get($id);

            if (!$item) {
                continue;
            }

            $categoryParent->remove($id);

            $categoryParent->add(
                $id,
                $this->getParents($item['pid'])
            );
        }
    }
}
