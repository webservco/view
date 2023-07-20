<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

/**
 * View services container.
 *
 * Contains services commonly used in application controllers:
 * - ViewContainerFactoryInterface
 * - ViewRendererInterface
 */
interface ViewServicesContainerInterface
{
    public function getViewContainerFactory(): ViewContainerFactoryInterface;

    public function getViewRenderer(): ViewRendererInterface;
}
