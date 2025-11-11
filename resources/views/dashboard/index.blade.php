<x-layouts.app>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-black">Dashboard</h1>
            <p class="mt-2 text-gray-600">Visão geral da sua atividade</p>
        </div>
        <a href="{{ route('projects.create') }}" 
           class="bg-black hover:bg-gray-800 text-white font-medium py-2 px-6 rounded transition-colors">
            + Novo Projeto
        </a>
    </div>

    <!-- Estatísticas -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
            <div class="text-2xl font-bold text-black">{{ $stats['total_projects'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Total de Projetos</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
            <div class="text-2xl font-bold text-black">{{ $stats['open_projects'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Projetos Abertos</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
            <div class="text-2xl font-bold text-black">{{ $stats['my_projects'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Meus Projetos</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
            <div class="text-2xl font-bold text-black">{{ $stats['my_proposals'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Minhas Propostas</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
            <div class="text-2xl font-bold text-black">{{ $stats['favorites'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Favoritos</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
            <div class="text-2xl font-bold text-black">{{ $stats['unread_notifications'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Notificações</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Projetos Recentes -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
                <h2 class="text-xl font-semibold text-black mb-4">Projetos Recentes</h2>
                <div class="space-y-4">
                    @forelse($recentProjects as $project)
                        <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                            <a href="{{ route('projects.show', $project->id) }}" class="text-lg font-medium text-black hover:text-gray-700">
                                {{ $project->title }}
                            </a>
                            <div class="text-sm text-gray-600 mt-1">
                                {{ $project->proposals->count() }} propostas • Prazo: {{ $project->ends_at->format('d/m/Y') }}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Nenhum projeto recente.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Minhas Propostas -->
        <div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6 mb-6">
                <h2 class="text-xl font-semibold text-black mb-4">Minhas Propostas</h2>
                <div class="space-y-3">
                    @forelse($myProposals as $proposal)
                        <div class="border-b border-gray-200 pb-3 last:border-0 last:pb-0">
                            <a href="{{ route('projects.show', $proposal->project_id) }}" class="text-sm font-medium text-black hover:text-gray-700">
                                {{ $proposal->project->title ?? 'Projeto' }}
                            </a>
                            <div class="text-xs text-gray-600 mt-1">
                                {{ $proposal->hours }}h • {{ $proposal->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 text-sm">Nenhuma proposta enviada.</p>
                    @endforelse
                </div>
            </div>

            <!-- Meus Projetos -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-black">Meus Projetos</h2>
                    <span class="text-sm text-gray-600">{{ $myProjects->count() }} total</span>
                </div>
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @forelse($myProjects as $project)
                        <div class="border-b border-gray-200 pb-3 last:border-0 last:pb-0">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('projects.show', $project->id) }}" class="text-sm font-medium text-black hover:text-gray-700 block truncate">
                                        {{ $project->title }}
                                    </a>
                                    <div class="flex items-center gap-2 text-xs text-gray-600 mt-1">
                                        <span>{{ $project->proposals->count() }} propostas</span>
                                        <span>•</span>
                                        <span class="px-1.5 py-0.5 rounded text-xs
                                            {{ $project->status->value === 'open' ? 'bg-black text-white' : 'bg-gray-300 text-black' }}">
                                            {{ $project->status->label() }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('projects.edit', $project->id) }}" 
                                   class="ml-2 text-xs text-black hover:text-gray-700 underline whitespace-nowrap">
                                    Editar
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 text-sm">Você ainda não criou projetos.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
