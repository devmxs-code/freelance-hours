<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectNotFoundException;
use App\Exceptions\ProposalNotAllowedException;
use App\Http\Requests\StoreProposalRequest;
use App\Services\Contracts\ProjectServiceInterface;
use App\Services\Contracts\ProposalServiceInterface;
use Illuminate\Http\RedirectResponse;

class ProposalController extends Controller
{
    public function __construct(
        private readonly ProposalServiceInterface $proposalService,
        private readonly ProjectServiceInterface $projectService
    ) {
    }

    public function store(StoreProposalRequest $request, int $projectId): RedirectResponse
    {
        try {
            $project = $this->projectService->getProjectById($projectId);

            $this->proposalService->createProposal(
                $project,
                $request->validated()
            );

            return redirect()
                ->route('projects.show', $project->id)
                ->with('success', 'Proposta enviada com sucesso!');
        } catch (ProjectNotFoundException $e) {
            abort(404, $e->getMessage());
        } catch (ProposalNotAllowedException $e) {
            return redirect()
                ->route('projects.show', $projectId)
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
}

