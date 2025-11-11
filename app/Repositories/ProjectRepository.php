<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function findAllPaginated(int $perPage = 12, array $filters = []): LengthAwarePaginator
    {
        $query = Project::with(['creator', 'proposals']);

        // Busca por texto
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtro por status
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Filtro por tecnologia
        if (!empty($filters['tech'])) {
            $query->whereJsonContains('tech_stack', $filters['tech']);
        }

        // Ordenação
        match ($filters['sort'] ?? 'latest') {
            'latest' => $query->latest(),
            'oldest' => $query->oldest(),
            'proposals' => $query->withCount('proposals')->orderBy('proposals_count', 'desc'),
            'deadline' => $query->orderBy('ends_at', 'asc'),
            default => $query->latest(),
        };

        return $query->paginate($perPage)->withQueryString();
    }

    public function findById(int $id): ?Project
    {
        return Project::find($id);
    }

    public function findByIdWithRelations(int $id, array $relations = []): ?Project
    {
        $query = Project::query();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query->find($id);
    }

    public function create(array $data): Project
    {
        return Project::create($data);
    }

    public function update(Project $project, array $data): bool
    {
        return $project->update($data);
    }

    public function delete(Project $project): bool
    {
        return $project->delete();
    }

    public function findByStatus(string $status): Collection
    {
        return Project::where('status', $status)
            ->with(['creator', 'proposals'])
            ->get();
    }
}

