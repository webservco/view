<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use Override;
use WebServCo\View\Contract\HTMLRendererInterface;

final class HTMLRenderer extends AbstractTemplateViewRenderer implements HTMLRendererInterface
{
    #[Override]
    public function getContentType(): string
    {
        return self::CONTENT_TYPE;
    }
}
