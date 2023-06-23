<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

/**
 * View renderer interface.
 *
 * Renders output by making use of ViewInterface object and template info from ViewContainerInterface.
 */
interface ViewRendererInterface
{
    /**
     * Return content type that the output will use.
     *
     * Can be called independently from the `render()` method.
     * Why: the code that calls this interfaces' `render()` method will also probably
     * create the Response object, which will need to know the correct Content-Type to use.
     * Not using a setter because implementations should use a constant for the actual value.
     */
    public function getContentType(): string;

    /**
     * Render output.
     *
     * Does not take template as parameter because template is optional.
     * For example a JSON renderer would not use templates.
     */
    public function render(ViewContainerInterface $viewContainer): string;
}
