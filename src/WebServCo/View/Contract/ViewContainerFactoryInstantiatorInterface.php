<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

interface ViewContainerFactoryInstantiatorInterface
{
    public function instantiateViewContainerFactory(string $viewContainerFactoryClass): ViewContainerFactoryInterface;
}
