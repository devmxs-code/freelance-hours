<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Sistema de Gestão',
            'Plataforma Web',
            'Aplicativo Mobile',
            'API RESTful',
            'Dashboard Analytics',
            'E-commerce',
            'Sistema CRM',
            'Plataforma SaaS',
            'Marketplace',
            'Sistema de Reservas',
        ];

        $descriptions = [
            '<p>Desenvolvimento completo de sistema robusto com funcionalidades avançadas.</p>',
            '<p>Criação de plataforma moderna e escalável utilizando as melhores tecnologias do mercado.</p>',
            '<p>Desenvolvimento de aplicativo mobile multiplataforma com interface intuitiva.</p>',
            '<p>API RESTful completa com documentação e testes automatizados.</p>',
            '<p>Dashboard interativo para análise de dados e métricas em tempo real.</p>',
        ];

        $techStacks = [
            ['Laravel', 'PHP', 'MySQL', 'Vue.js'],
            ['React', 'Node.js', 'MongoDB', 'TypeScript'],
            ['React Native', 'TypeScript', 'Firebase'],
            ['Next.js', 'TypeScript', 'PostgreSQL', 'Prisma'],
            ['Python', 'Django', 'PostgreSQL', 'Redis'],
            ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
            ['Node.js', 'Express', 'MongoDB', 'Socket.io'],
        ];

        return [
            'title' => fake()->randomElement($titles) . ' - ' . fake()->words(3, true),
            'description' => fake()->randomElement($descriptions) . '<p>' . fake()->paragraph() . '</p>',
            'ends_at' => fake()->dateTimeBetween('now', '+90 days'),
            'status' => fake()->randomElement([\App\Enums\ProjectStatus::OPEN->value, \App\Enums\ProjectStatus::CLOSED->value]),
            'tech_stack' => fake()->randomElement($techStacks),
            'created_by' => User::factory(),
        ];
    }
}
