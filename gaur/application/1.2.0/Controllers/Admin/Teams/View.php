<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Teams;

use App\Models\Admin\Teams\Team;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class View extends Controller
{
    use APIControllerTrait;

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

        echo view('app/admin/teams/view', $data);
    }

    /**
     * Toggle team status
     *
     * @param string $id team id
     *
     * @return void
     */
    protected function toggleStatus(string $id): void
    {
        $id   = (int)$id;
        $team = new Team();

        // Prevent invalid id
        if (!$team->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        $team->changeStatus($id);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }
}
