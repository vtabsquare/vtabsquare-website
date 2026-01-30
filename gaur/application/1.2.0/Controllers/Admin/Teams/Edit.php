<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Teams;

use App\Models\Admin\Teams\Team;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
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
     * @param string $id team id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id   = (int)$id;
        $team = (new Team())->get($id);

        if (!$team) {
            Response::pageNotFound();
            return;
        }

        $data = [];

        $data['team'] = $team;

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/teams/edit', $data);
    }

    /**
     * Submit form
     *
     * @param string $id team id
     *
     * @return void
     */
    protected function submit(string $id): void
    {
        $id   = (int)$id;
        $team = new Team();

        // Prevent invalid id
        if (!$team->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        if (!$this->validateInput()
            || !$this->validateImage()
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        $this->assembleImage($id);

        $team->update($id, $this->finputs);

        $message = 'Congratulations! team has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/teams'
                ]
            ]
        );
    }

    /**
     * Assemble image
     *
     * @param int $id team id
     *
     * @return void
     */
    protected function assembleImage(int $id): void
    {
        $image = (new Team())->getImage($id);

        $spath = FCPATH . 'images/teams/';

        if (Input::data('image') && $image) {
            unlink($spath . $image);

            $image = '';
        }

        if ($this->finputs['image']) {
            if ($image) {
                unlink($spath . $image);
            }
        } else {
            $this->finputs['image'] = $image;
        }
    }
}
