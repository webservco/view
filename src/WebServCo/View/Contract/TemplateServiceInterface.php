<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

/**
 * Template service interface.
 *
 * Contains general information about template structure.
 * Use case: separate themes, different templating engine usage.
 */
interface TemplateServiceInterface
{
    /**
     * Return absolute base path of the templates directory.
     */
    public function getAbsoluteBasePath(): string;

    /**
     * Return template file suffix to use (optional).
     */
    public function getFilenameSuffix(): string;
}
