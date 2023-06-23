<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

/**
 * Interface for classes that use a list of view renderers.
 */
interface ViewRendererListInterface
{
    /**
     * Get list of available / supported view renderers.
     *
     * key - interface; value - implementation.
     * The order of the array value is important,
     * if multiple supported view renderer match the requested one, the first one will be returned.
     * So for example if a client accepts any view renderer,
     * the order to this array will determine view renderer is preferred by the implementation.
     * eg. an api implementation would use JSON by default,
     * instead a frontend supporting both HTML and JSON would use HTML as default.
     *
     * @return array<string,string> interface/implementation
     */
    public function getAvailableViewRenderers(): array;
}
