<?php

namespace App\Services;

use App\DTOs\ProposalDTO;
use App\Exceptions\ProposalNotAllowedException;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Proposal;
use App\Repositories\Contracts\ProposalRepositoryInterface;
use App\Services\Contracts\ProposalServiceInterface;
use App\Services\Contracts\ProjectServiceInterface;

class ProposalService implements ProposalServiceInterface
{
    public function __construct(
        private readonly ProposalRepositoryInterface $proposalRepository,
        private readonly ProjectServiceInterface $projectService
    ) {
    }

    public function createProposal(Project $project, array $data): Proposal
    {
        if (!$this->projectService->isProjectOpen($project)) {
            throw new ProposalNotAllowedException(
                'Não é possível enviar proposta para um projeto fechado.'
            );
        }

        $dto = ProposalDTO::fromArray([
            ...$data,
            'project_id' => $project->id,
        ]);

        $proposal = $this->proposalRepository->createForProject($project, $dto->toArray());

        // Criar notificação para o criador do projeto
        if ($project->creator) {
            Notification::create([
                'user_id' => $project->creator->id,
                'project_id' => $project->id,
                'type' => 'new_proposal',
                'title' => 'Nova proposta recebida',
                'message' => "Uma nova proposta foi enviada para o projeto '{$project->title}' com {$proposal->hours} horas estimadas.",
            ]);
        }

        return $proposal;
    }

    public function getProposalsByProject(Project $project): array
    {
        return $this->proposalRepository
            ->findByProject($project)
            ->toArray();
    }
}

