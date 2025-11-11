<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Proposal;
use App\Services\Contracts\ProjectServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        private readonly ProjectServiceInterface $projectService
    ) {
    }

    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_projects' => Project::count(),
            'open_projects' => Project::where('status', 'open')->count(),
            'my_projects' => $user->projects()->count(),
            'my_proposals' => Proposal::whereIn('email', [$user->email])->count(),
            'favorites' => $user->favorites()->count(),
            'unread_notifications' => $user->unreadNotifications()->count(),
        ];

        $recentProjects = Project::with(['creator', 'proposals'])
            ->latest()
            ->limit(5)
            ->get();

        $myProjects = $user->projects()
            ->with('proposals')
            ->latest()
            ->get();

        $myProposals = Proposal::whereIn('email', [$user->email])
            ->with('project')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentProjects', 'myProjects', 'myProposals'));
    }
}
