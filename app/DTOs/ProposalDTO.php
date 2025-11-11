<?php

namespace App\DTOs;

readonly class ProposalDTO
{
    public function __construct(
        public string $email,
        public int $hours,
        public int $projectId,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            hours: (int) $data['hours'],
            projectId: $data['project_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'hours' => $this->hours,
            'project_id' => $this->projectId,
        ];
    }
}

