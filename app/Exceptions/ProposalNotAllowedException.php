<?php

namespace App\Exceptions;

use Exception;

class ProposalNotAllowedException extends Exception
{
    public function __construct(string $message = 'Não é possível enviar proposta para este projeto.')
    {
        parent::__construct($message, 422);
    }
}

