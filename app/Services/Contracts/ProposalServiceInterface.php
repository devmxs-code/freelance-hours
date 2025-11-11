<?php

namespace App\Services\Contracts;

use App\Models\Project;
use App\Models\Proposal;

interface ProposalServiceInterface
{
    public function createProposal(Project $project, array $data): Proposal;

    public function getProposalsByProject(Project $project): array;
}

