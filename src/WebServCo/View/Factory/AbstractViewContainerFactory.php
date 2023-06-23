<?php

declare(strict_types=1);

namespace WebServCo\View\Factory;

use OutOfBoundsException;
use UnexpectedValueException;
use WebServCo\View\Contract\ViewContainerFactoryInterface;
use WebServCo\View\Contract\ViewContainerInterface;
use WebServCo\View\Contract\ViewInterface;
use WebServCo\View\Service\ViewContainer;

use function array_key_exists;
use function is_bool;
use function is_int;
use function is_string;
use function sprintf;

abstract class AbstractViewContainerFactory implements ViewContainerFactoryInterface
{
    public function createViewContainerFromView(ViewInterface $view, string $templateName): ViewContainerInterface
    {
        /**
         * Return a ViewContainerInterface without the TemplateServiceInterface (will be set elsewhere).
         */
        return new ViewContainer($view, $templateName);
    }

    /**
     * Process boolean data.
     * phpcs:disable SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint
     * @param array<mixed> $data
     * phpcs:enable
     */
    protected function processBooleanData(string $key, array $data): bool
    {
        if (!array_key_exists($key, $data)) {
            throw new OutOfBoundsException(sprintf('Required key not found: "%s".', $key));
        }
        if (!is_bool($data[$key])) {
            throw new UnexpectedValueException(sprintf('Unexpected data type for "%s".', $key));
        }

        return $data[$key];
    }

    /**
     * Process int data.
     * phpcs:disable SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint
     * @param array<mixed> $data
     * phpcs:enable
     */
    protected function processIntData(string $key, array $data): int
    {
        if (!array_key_exists($key, $data)) {
            throw new OutOfBoundsException(sprintf('Required key not found: "%s".', $key));
        }
        if (!is_int($data[$key])) {
            throw new UnexpectedValueException(sprintf('Unexpected data type for "%s".', $key));
        }

        return $data[$key];
    }

    /**
     * Process string data.
     * phpcs:disable SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint
     * @param array<mixed> $data
     * phpcs:enable
     */
    protected function processStringData(string $key, array $data): string
    {
        if (!array_key_exists($key, $data)) {
            throw new OutOfBoundsException(sprintf('Required key not found: "%s".', $key));
        }
        if (!is_string($data[$key])) {
            throw new UnexpectedValueException(sprintf('Unexpected data type for "%s".', $key));
        }

        return $data[$key];
    }
}
