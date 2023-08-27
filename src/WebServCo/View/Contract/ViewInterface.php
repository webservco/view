<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

/**
 * View Interface.
 *
 * Implementing classes should only contain readonly properties needed for output using an optional template.
 */
interface ViewInterface
{
    public function escape(?string $input): ?string;
}
