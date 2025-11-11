<?php

namespace App\Exceptions;

use Exception;

class ProjectNotFoundException extends Exception
{
    public function __construct(int $projectId)
    {
        parent::__construct("Projeto com ID {$projectId} não encontrado.", 404);
    }
}

