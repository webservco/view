<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

interface HTMLRendererInterface extends ViewRendererInterface
{
    public const string CONTENT_TYPE = 'text/html';

    public function renderView(ViewInterface $view, string $templatePath): string;
}
