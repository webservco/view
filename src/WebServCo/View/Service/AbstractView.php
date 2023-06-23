<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use WebServCo\View\Contract\ViewInterface;

use function htmlspecialchars;

use const ENT_QUOTES;
use const ENT_SUBSTITUTE;

/**
 * An abstract ViewInterface implementation adding the method `escape()`
 */
abstract class AbstractView implements ViewInterface
{
    public function escape(string $input): string
    {
        return htmlspecialchars($input, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
