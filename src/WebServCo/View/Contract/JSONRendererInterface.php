<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

interface JSONRendererInterface extends ViewRendererInterface
{
    public const CONTENT_TYPE = 'application/json';
}
