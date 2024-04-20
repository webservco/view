<?php

declare(strict_types=1);

namespace WebServCo\View\View;

use WebServCo\View\Contract\ViewInterface;

/**
 * An example main view that could be used by applications.
 */
final class MainView extends AbstractView implements ViewInterface
{
    public function __construct(public readonly CommonView $commonView, public readonly string $data)
    {
    }
}
