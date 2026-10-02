<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use Override;
use WebServCo\View\Contract\TemplateServiceInterface;

use function rtrim;

use const DIRECTORY_SEPARATOR;

final class TemplateService implements TemplateServiceInterface
{
    public function __construct(private string $absoluteBasePath, private string $filenameSuffix)
    {
        // Make sure path contains trailing slash (trim + add back).
        $this->absoluteBasePath = rtrim($this->absoluteBasePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    #[Override]
    public function getAbsoluteBasePath(): string
    {
        return $this->absoluteBasePath;
    }

    #[Override]
    public function getFilenameSuffix(): string
    {
        return $this->filenameSuffix;
    }
}
