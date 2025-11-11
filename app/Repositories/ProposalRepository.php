<?php

namespace App\Repositories;

use App\Models\Proposal;
use App\Models\Project;
use App\Repositories\Contracts\ProposalRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProposalRepository implements ProposalRepositoryInterface
{
    public function createForProject(Project $project, array $data): Proposal
    {
        return $project->proposals()->create($data);
    }

    public function findByProject(Project $project): Collection
    {
        return $project->proposals()->latest()->get();
    }

    public function findById(int $id): ?Proposal
    {
        return Proposal::find($id);
    }

    public function delete(Proposal $proposal): bool
    {
        return $proposal->delete();
    }
}

