<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use WebServCo\View\Contract\ViewContainerFactoryInterface;
use WebServCo\View\Contract\ViewRendererInterface;
use WebServCo\View\Contract\ViewServicesContainerInterface;

/**
 * A simple ViewServicesContainerInterface implementation.
 */
final class ViewServicesContainer implements ViewServicesContainerInterface
{
    public function __construct(
        private ViewContainerFactoryInterface $viewContainerFactory,
        private ViewRendererInterface $viewRenderer,
    ) {
    }

    public function getViewContainerFactoryInterface(): ViewContainerFactoryInterface
    {
        return $this->viewContainerFactory;
    }

    public function getViewRendererInterface(): ViewRendererInterface
    {
        return $this->viewRenderer;
    }
}
