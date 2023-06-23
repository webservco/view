<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use WebServCo\View\Contract\HTMLRendererInterface;

final class HTMLRenderer extends AbstractTemplateViewRenderer implements HTMLRendererInterface
{
    public function getContentType(): string
    {
        return self::CONTENT_TYPE;
    }
}
