<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use WebServCo\View\Contract\JSONAPIRendererInterface;
use WebServCo\View\Contract\ViewContainerInterface;

use function json_encode;

use const JSON_THROW_ON_ERROR;

final class JSONAPIRenderer implements JSONAPIRendererInterface
{
    public function getContentType(): string
    {
        return self::CONTENT_TYPE;
    }

    /**
     * json_encode: Despite using JSON_THROW_ON_ERROR flag, Phan 5.4.1 throws PhanPossiblyFalseTypeArgument.
     * If adding is_string check, PHPStan and Psalm instead throw error.
     * Test: @see `Tests\Misc\Phan\PhanPossiblyFalseTypeArgumentTest`
     *
     * @suppress PhanPossiblyFalseTypeReturn
     */
    public function render(ViewContainerInterface $viewContainer): string
    {
        return json_encode($viewContainer->getView(), JSON_THROW_ON_ERROR);
    }
}
