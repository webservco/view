<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

use WebServCo\Data\Contract\Extraction\DataExtractionContainerInterface;

interface ViewContainerFactoryInstantiatorInterface
{
    public function instantiateViewContainerFactory(
        DataExtractionContainerInterface $dataExtractionContainer,
        string $viewContainerFactoryClass,
    ): ViewContainerFactoryInterface;
}
