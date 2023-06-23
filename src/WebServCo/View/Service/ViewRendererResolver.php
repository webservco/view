<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;
use WebServCo\View\Contract\ViewRendererInterface;
use WebServCo\View\Contract\ViewRendererResolverInterface;

use function array_key_exists;
use function class_implements;
use function current;
use function in_array;
use function interface_exists;
use function is_array;
use function is_string;

final class ViewRendererResolver implements ViewRendererResolverInterface
{
    /**
     * Get class name of view renderer to use, based on the requested interface and the list of available options.
     *
     * @param array<string,string> $availableViewRenderers interface/implementation
     */
    public function getViewRendererClass(array $availableViewRenderers, ServerRequestInterface $request): string
    {
        // Get requested view renderer interface.
        $requestedRendererInterface = $this->getRequestedViewRendererInterface($request);
        $this->validateRequestedRendererInterface($requestedRendererInterface);

        // Check if the requested renderer is available in our list.
        if (array_key_exists($requestedRendererInterface, $availableViewRenderers)) {
            // Return the concrete class implementing the requested renderer interface.
            return $availableViewRenderers[$requestedRendererInterface];
        }

        /**
         * The exact requested renderer is not in the list of available renderers.
         * Check the "any" flag. For this, the requested renderer should be exactly the base renderer interface.
         */
        if ($requestedRendererInterface === ViewRendererInterface::class) {
            // This means that the client specifically accepts any renderer.
            // Return the first available renderer.
            $viewRendererClass = current($availableViewRenderers);
            if (!is_string($viewRendererClass)) {
                throw new UnexpectedValueException('Class name is not a string.');
            }

            return $viewRendererClass;
        }

        // None of the available renderers matched the requested one and client does not accept "any" renderer.
        throw new UnexpectedValueException('No View renderer available based on the request.');
    }

    /**
     * Get which view renderer interface we should use based on request "accept" header.
     * Does not perform validation (separate method exists).
     */
    private function getRequestedViewRendererInterface(ServerRequestInterface $request): string
    {
        // Get class name from request attribute.
        $requestViewRendererInterface = $request->getAttribute('ViewRendererInterface');
        if (!is_string($requestViewRendererInterface)) {
            throw new UnexpectedValueException('Requested View renderer interface class is not set.');
        }

        // Make sure class exists. $autoload parameter must be "true" in order for this to work.
        if (!interface_exists($requestViewRendererInterface, true)) {
            throw new UnexpectedValueException('Requested View renderer interface class does not exist.');
        }

        return $requestViewRendererInterface;
    }

    /**
     * @return array<string,string>
     */
    private function getRequestedViewRendererInterfaceImplementedInterfaces(string $requestViewRendererInterface): array
    {
        $interfaces = class_implements($requestViewRendererInterface);
        if (!is_array($interfaces)) {
            throw new UnexpectedValueException('Interfaces list is not an array.');
        }

        return $interfaces;
    }

    /**
     * Make sure requested view renderer is indeed a ViewRendererInterface implementation.
     */
    private function validateRequestedRendererInterface(string $requestedRendererInterface): bool
    {
        // Get the list of interfaces implemented by the requested view renderer.
        $interfaces = $this->getRequestedViewRendererInterfaceImplementedInterfaces($requestedRendererInterface);

        // Check if ViewRendererInterface is in the list of interfaces implemented by the requested view renderer,
        if (in_array(ViewRendererInterface::class, $interfaces, true)) {
            return true;
        }

        // Check if the requested view renderer is actually the ViewRendererInterface (the "any" flag).
        if ($requestedRendererInterface === ViewRendererInterface::class) {
            return true;
        }

        throw new UnexpectedValueException('Requested View Renderer does not implement required interface.');
    }
}
