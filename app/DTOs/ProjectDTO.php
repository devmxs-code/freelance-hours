<?php

namespace App\DTOs;

readonly class ProjectDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public \DateTime $endsAt,
        public string $status,
        public array $techStack,
        public int $createdBy,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            endsAt: is_string($data['ends_at']) 
                ? new \DateTime($data['ends_at']) 
                : $data['ends_at'],
            status: $data['status'] ?? 'open',
            techStack: $data['tech_stack'] ?? [],
            createdBy: $data['created_by'] ?? auth()->id(),
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'ends_at' => $this->endsAt->format('Y-m-d H:i:s'),
            'status' => $this->status,
            'tech_stack' => $this->techStack,
            'created_by' => $this->createdBy,
        ];
    }
}

