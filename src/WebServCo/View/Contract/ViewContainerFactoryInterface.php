<?php

declare(strict_types=1);

namespace WebServCo\View\Contract;

interface ViewContainerFactoryInterface
{
    /**
     * Create from array data.
     *
     * This is usually the main method used (internally it will call `createViewContainerFromView`).
     * @phpcs:disable SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint
     * @param array<mixed> $data
     * @phpcs:enable
     */
    public function createViewContainerFromData(array $data): ViewContainerInterface;

    /**
     * Create from a pre-existing View object.
     *
     * Usually called from `createViewContainerFromData`
     */
    public function createViewContainerFromView(ViewInterface $view, string $templateName): ViewContainerInterface;
}
