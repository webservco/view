<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

interface ViewRendererInstantiatorInterface
{
    public function instantiateViewRenderer(string $viewRendererClass): ViewRendererInterface;
}
