<?php

declare(strict_types=1);

namespace WebServCo\View\Factory;

use WebServCo\View\Contract\ViewContainerFactoryInterface;
use WebServCo\View\Contract\ViewContainerInterface;
use WebServCo\View\Contract\ViewInterface;
use WebServCo\View\Service\ViewContainer;

/**
 * A ViewContainerFactoryInterface implementation.
 */
final class ViewContainerFactory implements ViewContainerFactoryInterface
{
    public function createViewContainerFromView(ViewInterface $view, string $templateName): ViewContainerInterface
    {
        /**
         * Return a ViewContainerInterface without the TemplateServiceInterface (will be set elsewhere).
         */
        return new ViewContainer($view, $templateName);
    }
}
