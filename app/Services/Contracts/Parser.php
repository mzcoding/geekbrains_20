<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface Parser
{
    public function setLink(string $link): Parser;
    public function saveParseData(): void;
}
