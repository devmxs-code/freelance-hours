<?php

namespace App\Services\Contracts;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProjectServiceInterface
{
    public function getAllProjects(int $perPage = 12, array $filters = []): LengthAwarePaginator;

    public function getProjectById(int $id): Project;

    public function createProject(array $data): Project;

    public function updateProject(Project $project, array $data): Project;

    public function deleteProject(Project $project): bool;

    public function isProjectOpen(Project $project): bool;
}

