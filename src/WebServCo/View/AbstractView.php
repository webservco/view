<?php

declare(strict_types=1);

namespace WebServCo\View;

use WebServCo\View\Contract\ViewInterface;

use function htmlspecialchars;

use const ENT_QUOTES;
use const ENT_SUBSTITUTE;

/**
 * An abstract ViewInterface implementation adding the method `escape()`
 */
abstract class AbstractView implements ViewInterface
{
    public function escape(?string $input): ?string
    {
        if ($input === null) {
            return null;
        }

        return htmlspecialchars($input, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
