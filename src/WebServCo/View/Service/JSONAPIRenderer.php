<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use Override;
use WebServCo\View\Contract\JSONAPIRendererInterface;
use WebServCo\View\Contract\ViewContainerInterface;

use function json_encode;

use const JSON_THROW_ON_ERROR;

final class JSONAPIRenderer implements JSONAPIRendererInterface
{
    #[Override]
    public function getContentType(): string
    {
        return self::CONTENT_TYPE;
    }

    #[Override]
    public function renderViewContainer(ViewContainerInterface $viewContainer): string
    {
        return json_encode($viewContainer->getView(), JSON_THROW_ON_ERROR);
    }
}
