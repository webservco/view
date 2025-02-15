<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

interface JSONAPIRendererInterface extends ViewRendererInterface
{
    public const string CONTENT_TYPE = 'application/vnd.api+json';
}
