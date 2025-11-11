<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Project $project): RedirectResponse
    {
        $user = Auth::user();

        Favorite::firstOrCreate([
            'user_id' => $user->id,
            'project_id' => $project->id,
        ]);

        return back()->with('success', 'Projeto adicionado aos favoritos!');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->delete();

        return back()->with('success', 'Projeto removido dos favoritos!');
    }
}
