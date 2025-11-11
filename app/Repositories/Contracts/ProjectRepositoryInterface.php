<?php

namespace App\Repositories\Contracts;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProjectRepositoryInterface
{
    public function findAllPaginated(int $perPage = 12, array $filters = []): LengthAwarePaginator;

    public function findById(int $id): ?Project;

    public function findByIdWithRelations(int $id, array $relations = []): ?Project;

    public function create(array $data): Project;

    public function update(Project $project, array $data): bool;

    public function delete(Project $project): bool;

    public function findByStatus(string $status): Collection;
}

