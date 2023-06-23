<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

use Psr\Http\Message\ServerRequestInterface;

interface ViewRendererResolverInterface
{
    /**
     * Get class name of view renderer to use, based on the requested interface and the list of available options.
     *
     * @param array<string,string> $availableViewRenderers interface/implementation
     */
    public function getViewRendererClass(array $availableViewRenderers, ServerRequestInterface $request): string;
}
