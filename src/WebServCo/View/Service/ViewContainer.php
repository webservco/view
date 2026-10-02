<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use Override;
use UnexpectedValueException;
use WebServCo\View\Contract\TemplateServiceInterface;
use WebServCo\View\Contract\ViewContainerInterface;
use WebServCo\View\Contract\ViewInterface;

use function sprintf;

/**
 * A ViewContainerInterface implementation.
 */
final class ViewContainer implements ViewContainerInterface
{
    private ?TemplateServiceInterface $templateService = null;

    /**
     * $templateName is without prefix and can be a partial directory structure (eg. `user/profile`).
     */
    public function __construct(private ViewInterface $view, private string $templateName)
    {
    }

    #[Override]
    public function getTemplatePath(): string
    {
        if ($this->templateService === null) {
            throw new UnexpectedValueException('Template service not set.');
        }

        return sprintf(
            '%s%s%s',
            $this->templateService->getAbsoluteBasePath(),
            $this->templateName,
            $this->templateService->getFilenameSuffix(),
        );
    }

    #[Override]
    public function getView(): ViewInterface
    {
        return $this->view;
    }

    #[Override]
    public function setTemplateService(TemplateServiceInterface $templateService): bool
    {
        $this->templateService = $templateService;

        return true;
    }
}
