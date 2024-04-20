<?php

declare(strict_types=1);

namespace WebServCo\View\View;

use WebServCo\View\Contract\ViewInterface;

/**
 * A common View that could be used by other views.
 */
final class CommonView extends AbstractView implements ViewInterface
{
    public function __construct(
        // idea: set this dynamically as a route attribute by using a middleware.
        public readonly string $baseUrl,
        public readonly string $currentUrl,
    ) {
    }
}
