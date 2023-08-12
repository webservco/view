<?php

declare(strict_types=1);

namespace WebServCo\View\Factory;

use WebServCo\Data\Contract\Extraction\DataExtractionContainerInterface;
use WebServCo\View\Contract\ViewContainerFactoryInterface;
use WebServCo\View\Contract\ViewContainerInterface;
use WebServCo\View\Contract\ViewInterface;
use WebServCo\View\Service\ViewContainer;

abstract class AbstractViewContainerFactory implements ViewContainerFactoryInterface
{
    public function __construct(protected DataExtractionContainerInterface $dataExtractionContainer)
    {
    }

    public function createViewContainerFromView(ViewInterface $view, string $templateName): ViewContainerInterface
    {
        /**
         * Return a ViewContainerInterface without the TemplateServiceInterface (will be set elsewhere).
         */
        return new ViewContainer($view, $templateName);
    }
}
