<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

interface ViewContainerFactoryInterface
{
    /**
     * Create view container from view interface.
     *
     * Note: There was initially also another method `createViewContainerFromData` (check repo history)
     * It was supposed to be used in projects to process data from an arbitrary array (as in WSFW).
     * Projects would use custom implementations of this interface, implement that method, and call the current method
     * from inside it.
     * However it turned out to be much better (simplicity, performance) if Controller create the ViewInterface directly
     */
    public function createViewContainerFromView(ViewInterface $view, string $templateName): ViewContainerInterface;
}
