<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Desenvolvimento Web', 'slug' => 'desenvolvimento-web', 'description' => 'Projetos de desenvolvimento web', 'color' => '#3B82F6'],
            ['name' => 'Aplicativos Mobile', 'slug' => 'aplicativos-mobile', 'description' => 'Desenvolvimento de apps mobile', 'color' => '#10B981'],
            ['name' => 'E-commerce', 'slug' => 'e-commerce', 'description' => 'Plataformas de e-commerce', 'color' => '#F59E0B'],
            ['name' => 'API & Backend', 'slug' => 'api-backend', 'description' => 'APIs e sistemas backend', 'color' => '#8B5CF6'],
            ['name' => 'Design UI/UX', 'slug' => 'design-ui-ux', 'description' => 'Design de interfaces', 'color' => '#EC4899'],
            ['name' => 'DevOps', 'slug' => 'devops', 'description' => 'Infraestrutura e DevOps', 'color' => '#6366F1'],
            ['name' => 'Machine Learning', 'slug' => 'machine-learning', 'description' => 'Projetos de ML e IA', 'color' => '#14B8A6'],
            ['name' => 'Blockchain', 'slug' => 'blockchain', 'description' => 'Projetos blockchain', 'color' => '#F97316'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
