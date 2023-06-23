<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use WebServCo\View\Contract\TemplateServiceInterface;

use function rtrim;

use const DIRECTORY_SEPARATOR;

final class TemplateService implements TemplateServiceInterface
{
    public function __construct(private string $absoluteBasePath, private string $filenameSuffix)
    {
        // Make sure path contains trailing slash (trim + add back).
        $this->absoluteBasePath = rtrim($this->absoluteBasePath, '/') . DIRECTORY_SEPARATOR;
    }

    public function getAbsoluteBasePath(): string
    {
        return $this->absoluteBasePath;
    }

    public function getFilenameSuffix(): string
    {
        return $this->filenameSuffix;
    }
}
