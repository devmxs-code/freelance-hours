<?php

namespace App\Repositories\Contracts;

use App\Models\Proposal;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

interface ProposalRepositoryInterface
{
    public function createForProject(Project $project, array $data): Proposal;

    public function findByProject(Project $project): Collection;

    public function findById(int $id): ?Proposal;

    public function delete(Proposal $proposal): bool;
}

