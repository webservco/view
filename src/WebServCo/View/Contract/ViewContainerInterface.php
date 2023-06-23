<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

/**
 * View container interface.
 *
 * Contains the actual ViewInterface object and information about the template to use.
 * Used to transmit the ViewInterface object to the ViewRendererInterface.
 * Template path information is needed by the ViewRendererInterface, but tied to the ViewInterface so declared here.
 * Separate methods for setting basePath and templateName for flexibility;
 * can be set in different steps of processing, eg. templateName in specific part and basePath in general processing.
 */
interface ViewContainerInterface
{
    /**
     * Return the full template path to use when rendering the view.
     *
     * Must process: basePath, fileSuffix (TemplateServiceInterface), templateName.
     */
    public function getTemplatePath(): string;

    /**
     * Get ViewInterface object.
     */
    public function getView(): ViewInterface;

    public function setTemplateService(TemplateServiceInterface $templateService): bool;
}
