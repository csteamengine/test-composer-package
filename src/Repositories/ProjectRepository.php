<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository.
 */
class ProjectRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'order', $sort = 'asc') : LengthAwarePaginator
    {
        return $this->model
            ->where('is_active', 1)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Project
     * @throws \Throwable
     */
    public function create(array $data) : Project
    {

        return DB::transaction(function () use ($data) {
            $project = parent::create([
                'title'     => $data['title'],
                'description'  => preg_replace("/\\r\\n+/", '',$data['description']),
                'short_description'    => $data['short_description'],
                'medium' => $data['medium'],
                'date_started' => $data['date_started'],
                'date_completed' => $data['date_completed'],
                'is_active' => $data['is_active'],
            ]);

            if ($project) {
//                event(new RoleCreated($role));

                return $project;
            }

            throw new GeneralException(trans('exceptions.backend.projects.create_error'));
        });
    }

    /**
     * @param Project $project
     * @param array $data
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(Project $project, array $data)
    {
        return DB::transaction(function () use ($project, $data) {
            if ($project->update([
                'title'     => $data['title'],
                'description'  => preg_replace("/\\r\\n+/", '',$data['description']),
                'short_description'    => $data['short_description'],
                'medium' => $data['medium'],
                'date_started' => $data['date_started'],
                'date_completed' => $data['date_completed'],
                'is_active' => $data['is_active'],
            ])) {
//                event(new RoleUpdated($role));

                return $project;
            }

            throw new GeneralException(trans('exceptions.backend.access.projects.update_error'));
        });
    }
}
