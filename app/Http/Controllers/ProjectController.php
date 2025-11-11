<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectNotFoundException;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectServiceInterface $projectService
    ) {
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 12);
        $search = $request->get('search');
        $status = $request->get('status');
        $sort = $request->get('sort', 'latest');
        $tech = $request->get('tech');

        $projects = $this->projectService->getAllProjects($perPage, [
            'search' => $search,
            'status' => $status,
            'sort' => $sort,
            'tech' => $tech,
        ]);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('projects.create', compact('categories'));
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        $project = $this->projectService->createProject($data);

        // Sincronizar categorias
        if ($request->has('categories')) {
            $project->categories()->sync($request->categories);
        }

        return redirect()
            ->route('projects.show', $project->id)
            ->with('success', 'Projeto criado com sucesso!');
    }

    public function show(int $id)
    {
        try {
            $project = $this->projectService->getProjectById($id);

            return view('projects.show', compact('project'));
        } catch (ProjectNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function edit(int $id)
    {
        try {
            $project = $this->projectService->getProjectById($id);
            $user = Auth::user();

            // Verificar se o usuário é o criador ou admin
            if ($project->created_by !== $user->id && !$user->isAdmin()) {
                abort(403, 'Você não tem permissão para editar este projeto.');
            }

            $categories = \App\Models\Category::all();
            return view('projects.edit', compact('project', 'categories'));
        } catch (ProjectNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function update(UpdateProjectRequest $request, int $id): RedirectResponse
    {
        try {
            $project = $this->projectService->getProjectById($id);
            $user = Auth::user();

            // Verificar se o usuário é o criador ou admin
            if ($project->created_by !== $user->id && !$user->isAdmin()) {
                abort(403, 'Você não tem permissão para editar este projeto.');
            }

            $validated = $request->validated();
            $this->projectService->updateProject($project, $validated);

            // Sincronizar categorias
            if ($request->has('categories')) {
                $project->categories()->sync($request->categories);
            } else {
                $project->categories()->detach();
            }

            return redirect()
                ->route('dashboard')
                ->with('success', 'Projeto atualizado com sucesso!');
        } catch (ProjectNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }
}

