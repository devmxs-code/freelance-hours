<?php

namespace App\Services;

use App\DTOs\ProjectDTO;
use App\Exceptions\ProjectNotFoundException;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository
    ) {
    }

    public function getAllProjects(int $perPage = 12, array $filters = []): LengthAwarePaginator
    {
        return $this->projectRepository->findAllPaginated($perPage, $filters);
    }

    public function getProjectById(int $id): Project
    {
        $project = $this->projectRepository->findByIdWithRelations(
            $id,
            ['creator', 'proposals', 'categories', 'ratings']
        );

        if (!$project) {
            throw new ProjectNotFoundException($id);
        }

        return $project;
    }

    public function createProject(array $data): Project
    {
        $dto = ProjectDTO::fromArray($data);

        return $this->projectRepository->create($dto->toArray());
    }

    public function updateProject(Project $project, array $data): Project
    {
        // Preparar dados para atualização (não incluir created_by)
        $updateData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'ends_at' => is_string($data['ends_at']) 
                ? new \DateTime($data['ends_at']) 
                : $data['ends_at'],
            'status' => $data['status'],
            'tech_stack' => $data['tech_stack'] ?? [],
        ];

        // Converter ends_at para formato de banco se necessário
        if ($updateData['ends_at'] instanceof \DateTime) {
            $updateData['ends_at'] = $updateData['ends_at']->format('Y-m-d H:i:s');
        }

        $this->projectRepository->update($project, $updateData);

        return $project->fresh();
    }

    public function deleteProject(Project $project): bool
    {
        return $this->projectRepository->delete($project);
    }

    public function isProjectOpen(Project $project): bool
    {
        return $project->isOpen();
    }
}

