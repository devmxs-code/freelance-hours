<?php

namespace Database\Seeders;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RealProjectsSeeder extends Seeder
{
    private array $realUsers = [
        [
            'name' => 'Tech Solutions Brasil',
            'email' => 'contato@techsolutions.com.br',
            'password' => 'password123',
        ],
        [
            'name' => 'Digital Agency Pro',
            'email' => 'hello@digitalagency.pro',
            'password' => 'password123',
        ],
        [
            'name' => 'Code Labs Innovation',
            'email' => 'info@codelabs.io',
            'password' => 'password123',
        ],
        [
            'name' => 'Web Studio Premium',
            'email' => 'contato@webstudio.com',
            'password' => 'password123',
        ],
        [
            'name' => 'Dev Team Experts',
            'email' => 'team@devteam.com',
            'password' => 'password123',
        ],
        [
            'name' => 'Software House Global',
            'email' => 'contact@softhouse.global',
            'password' => 'password123',
        ],
        [
            'name' => 'Innovation Hub',
            'email' => 'hello@innovationhub.tech',
            'password' => 'password123',
        ],
        [
            'name' => 'App Development Co',
            'email' => 'info@appdev.co',
            'password' => 'password123',
        ],
    ];

    private array $realProjects = [
        [
            'title' => 'Sistema de Gestão de E-commerce com Laravel',
            'description' => '<p>Desenvolvimento completo de uma plataforma de e-commerce robusta utilizando Laravel 11. O sistema deve incluir:</p><ul><li>Gestão de produtos e categorias</li><li>Carrinho de compras e checkout</li><li>Integração com gateways de pagamento (Stripe, PayPal)</li><li>Painel administrativo completo</li><li>Sistema de avaliações e reviews</li><li>Relatórios e analytics</li></ul><p>O projeto deve seguir as melhores práticas de segurança, performance e SEO.</p>',
            'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Vue.js', 'Tailwind CSS', 'Stripe API'],
            'ends_at' => '+30 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 0, // Tech Solutions Brasil
        ],
        [
            'title' => 'Aplicativo Mobile React Native para Delivery',
            'description' => '<p>Criação de aplicativo mobile multiplataforma (iOS e Android) para serviço de delivery de comida. Funcionalidades principais:</p><ul><li>Cadastro e autenticação de usuários</li><li>Catálogo de restaurantes e produtos</li><li>Carrinho e sistema de pedidos</li><li>Rastreamento em tempo real</li><li>Notificações push</li><li>Integração com mapas (Google Maps)</li><li>Sistema de avaliações</li></ul>',
            'tech_stack' => ['React Native', 'TypeScript', 'Node.js', 'MongoDB', 'Firebase', 'Google Maps API'],
            'ends_at' => '+45 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 1, // Digital Agency Pro
        ],
        [
            'title' => 'Dashboard Analytics com Python e Machine Learning',
            'description' => '<p>Desenvolvimento de dashboard interativo para análise de dados com integração de machine learning. O sistema deve processar grandes volumes de dados e fornecer insights acionáveis.</p><ul><li>ETL de múltiplas fontes de dados</li><li>Modelos preditivos com scikit-learn</li><li>Visualizações interativas com Plotly/Dash</li><li>API REST para integração</li><li>Relatórios automatizados</li><li>Alertas e notificações</li></ul>',
            'tech_stack' => ['Python', 'Pandas', 'Scikit-learn', 'Plotly', 'FastAPI', 'PostgreSQL', 'Docker'],
            'ends_at' => '+60 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 2, // Code Labs Innovation
        ],
        [
            'title' => 'Plataforma SaaS de Gestão de Projetos',
            'description' => '<p>Plataforma completa de gestão de projetos com funcionalidades avançadas de colaboração e produtividade.</p><ul><li>Kanban boards e Gantt charts</li><li>Gestão de tarefas e subtarefas</li><li>Time tracking integrado</li><li>Comunicação em tempo real (chat)</li><li>Integração com ferramentas populares (Slack, GitHub, Jira)</li><li>Relatórios e métricas de produtividade</li><li>Sistema de permissões granular</li></ul>',
            'tech_stack' => ['Next.js', 'TypeScript', 'Node.js', 'PostgreSQL', 'Redis', 'WebSockets', 'Prisma'],
            'ends_at' => '+90 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 3, // Web Studio Premium
        ],
        [
            'title' => 'API RESTful para Sistema de Reservas',
            'description' => '<p>Desenvolvimento de API robusta e escalável para sistema de reservas de hotéis e restaurantes.</p><ul><li>CRUD completo de estabelecimentos</li><li>Sistema de disponibilidade em tempo real</li><li>Gestão de reservas e cancelamentos</li><li>Notificações por email e SMS</li><li>Documentação completa com Swagger/OpenAPI</li><li>Rate limiting e autenticação JWT</li><li>Testes automatizados (unitários e integração)</li></ul>',
            'tech_stack' => ['Node.js', 'Express', 'TypeScript', 'MongoDB', 'JWT', 'Swagger', 'Jest'],
            'ends_at' => '+25 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 4, // Dev Team Experts
        ],
        [
            'title' => 'Site Institucional WordPress com Customização Avançada',
            'description' => '<p>Criação de site institucional moderno e responsivo com WordPress, incluindo customizações avançadas e otimizações.</p><ul><li>Design responsivo e moderno</li><li>Custom post types e campos personalizados</li><li>Formulários de contato avançados</li><li>SEO otimizado</li><li>Integração com Google Analytics</li><li>Blog com sistema de categorias</li><li>Galeria de imagens otimizada</li><li>Performance otimizada (cache, CDN)</li></ul>',
            'tech_stack' => ['WordPress', 'PHP', 'MySQL', 'JavaScript', 'CSS3', 'ACF', 'Yoast SEO'],
            'ends_at' => '+20 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 5, // Software House Global
        ],
        [
            'title' => 'Sistema de CRM com Vue.js e Laravel',
            'description' => '<p>Desenvolvimento de sistema CRM completo para gestão de relacionamento com clientes.</p><ul><li>Gestão de leads e oportunidades</li><li>Pipeline de vendas personalizável</li><li>Histórico de interações</li><li>Automação de marketing (email marketing)</li><li>Relatórios e dashboards</li><li>Integração com telefonia (VoIP)</li><li>Exportação de dados (CSV, Excel)</li></ul>',
            'tech_stack' => ['Laravel', 'Vue.js', 'PHP', 'MySQL', 'Redis', 'Laravel Echo', 'Chart.js'],
            'ends_at' => '+50 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 0, // Tech Solutions Brasil (segundo projeto)
        ],
        [
            'title' => 'Aplicativo de Finanças Pessoais com Flutter',
            'description' => '<p>Desenvolvimento de aplicativo mobile para controle financeiro pessoal com interface intuitiva e funcionalidades avançadas.</p><ul><li>Gestão de receitas e despesas</li><li>Categorização automática de transações</li><li>Gráficos e relatórios visuais</li><li>Metas e orçamentos</li><li>Backup na nuvem</li><li>Exportação de relatórios (PDF)</li><li>Modo escuro/claro</li></ul>',
            'tech_stack' => ['Flutter', 'Dart', 'Firebase', 'SQLite', 'Provider', 'Charts'],
            'ends_at' => '+35 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 6, // Innovation Hub
        ],
        [
            'title' => 'Marketplace B2B com Microserviços',
            'description' => '<p>Plataforma marketplace B2B complexa utilizando arquitetura de microserviços.</p><ul><li>Múltiplos serviços independentes</li><li>API Gateway para roteamento</li><li>Sistema de busca avançada (Elasticsearch)</li><li>Gestão de catálogo de produtos</li><li>Sistema de pedidos e pagamentos</li><li>Notificações em tempo real</li><li>Monitoramento e logging centralizado</li></ul>',
            'tech_stack' => ['Node.js', 'Docker', 'Kubernetes', 'PostgreSQL', 'Redis', 'RabbitMQ', 'Elasticsearch'],
            'ends_at' => '+120 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 1, // Digital Agency Pro (segundo projeto)
        ],
        [
            'title' => 'Sistema de Gestão Escolar',
            'description' => '<p>Plataforma completa para gestão de instituições de ensino.</p><ul><li>Gestão de alunos, professores e turmas</li><li>Controle de frequência e notas</li><li>Portal do aluno e portal do professor</li><li>Comunicação entre escola e pais</li><li>Relatórios acadêmicos</li><li>Biblioteca digital</li><li>Calendário acadêmico</li></ul>',
            'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Vue.js', 'Bootstrap', 'PDF', 'Email'],
            'ends_at' => '+75 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 2, // Code Labs Innovation (segundo projeto)
        ],
        [
            'title' => 'Plataforma de Cursos Online (E-learning)',
            'description' => '<p>Desenvolvimento de plataforma completa para criação e venda de cursos online.</p><ul><li>Criação de cursos com vídeos, textos e quizzes</li><li>Sistema de certificados</li><li>Área de membros</li><li>Integração com pagamentos</li><li>Fórum de discussão</li><li>Progresso do aluno</li><li>Relatórios de vendas e alunos</li></ul>',
            'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Vue.js', 'FFmpeg', 'Stripe', 'AWS S3'],
            'ends_at' => '+80 days',
            'status' => ProjectStatus::OPEN,
            'user_index' => 3, // Web Studio Premium (segundo projeto)
        ],
        [
            'title' => 'Sistema de Agendamento Online',
            'description' => '<p>Plataforma para agendamento de serviços online com múltiplos prestadores.</p><ul><li>Cadastro de prestadores e serviços</li><li>Calendário de disponibilidade</li><li>Sistema de agendamento em tempo real</li><li>Lembretes por email e SMS</li><li>Gestão de clientes</li><li>Relatórios de agendamentos</li><li>Integração com Google Calendar</li></ul>',
            'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'JavaScript', 'FullCalendar', 'Twilio', 'Google API'],
            'ends_at' => '+30 days',
            'status' => ProjectStatus::CLOSED,
            'user_index' => 4, // Dev Team Experts (segundo projeto)
        ],
        [
            'title' => 'Dashboard de Monitoramento de Servidores',
            'description' => '<p>Sistema de monitoramento em tempo real de servidores e infraestrutura.</p><ul><li>Coleta de métricas (CPU, RAM, Disco)</li><li>Alertas configuráveis</li><li>Gráficos em tempo real</li><li>Histórico de métricas</li><li>Integração com múltiplos servidores</li><li>Dashboard personalizável</li><li>Notificações por email/Slack</li></ul>',
            'tech_stack' => ['Python', 'Django', 'PostgreSQL', 'Redis', 'WebSockets', 'Grafana', 'Prometheus'],
            'ends_at' => '+40 days',
            'status' => ProjectStatus::CLOSED,
            'user_index' => 5, // Software House Global (segundo projeto)
        ],
        [
            'title' => 'Aplicativo de Delivery para Restaurantes',
            'description' => '<p>App completo para restaurantes gerenciarem pedidos de delivery.</p><ul><li>Interface para restaurante (painel admin)</li><li>App para entregadores</li><li>App para clientes</li><li>Rastreamento de pedidos</li><li>Integração com mapas</li><li>Sistema de avaliações</li><li>Notificações push</li></ul>',
            'tech_stack' => ['React Native', 'Node.js', 'MongoDB', 'Socket.io', 'Google Maps', 'Firebase'],
            'ends_at' => '+50 days',
            'status' => ProjectStatus::CLOSED,
            'user_index' => 7, // App Development Co
        ],
    ];

    public function run(): void
    {
        // Criar usuários reais
        $users = collect();
        
        foreach ($this->realUsers as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'email_verified_at' => now(),
                ]
            );
            $users->push($user);
        }

        // Criar projetos reais vinculados aos usuários
        foreach ($this->realProjects as $projectData) {
            $user = $users[$projectData['user_index']];
            
            $project = Project::create([
                'title' => $projectData['title'],
                'description' => $projectData['description'],
                'tech_stack' => $projectData['tech_stack'],
                'ends_at' => now()->modify($projectData['ends_at']),
                'status' => $projectData['status'],
                'created_by' => $user->id,
            ]);

            // Criar propostas realistas para cada projeto
            $proposalsCount = random_int(3, 25);
            
            // Criar propostas de outros usuários (não o criador)
            $otherUsers = $users->where('id', '!=', $user->id)->random(min($proposalsCount, $users->count() - 1));
            
            for ($i = 0; $i < $proposalsCount; $i++) {
                // Usar emails de empresas reais para propostas
                $proposalEmails = [
                    'dev@startup.com.br',
                    'contato@freelancer.dev',
                    'team@webdev.agency',
                    'info@techstudio.io',
                    'hello@codefactory.com',
                    'contact@digitalworks.net',
                    'team@appmakers.co',
                    'dev@softwarelab.com',
                ];
                
                Proposal::create([
                    'email' => fake()->randomElement($proposalEmails),
                    'hours' => $this->estimateHours($projectData['tech_stack'], $projectData['ends_at']),
                    'project_id' => $project->id,
                    'created_at' => now()->subDays(random_int(0, 10)),
                ]);
            }
        }

        $this->command->info('✅ ' . count($this->realUsers) . ' usuários reais criados!');
        $this->command->info('✅ ' . count($this->realProjects) . ' projetos reais criados e vinculados aos usuários!');
    }

    private function estimateHours(array $techStack, string $deadline): int
    {
        $days = (int) str_replace(['+', ' days'], '', $deadline);
        
        // Estimativa baseada na complexidade e prazo
        $baseHours = match (true) {
            $days <= 30 => random_int(20, 80),
            $days <= 60 => random_int(80, 200),
            $days <= 90 => random_int(200, 400),
            default => random_int(400, 800),
        };

        // Ajuste baseado no número de tecnologias
        $techCount = count($techStack);
        $multiplier = 1 + ($techCount * 0.1);

        return (int) ($baseHours * $multiplier);
    }
}
