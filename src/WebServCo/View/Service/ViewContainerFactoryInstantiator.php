<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use LogicException;
use OutOfRangeException;
use UnexpectedValueException;
use WebServCo\View\Contract\ViewContainerFactoryInstantiatorInterface;
use WebServCo\View\Contract\ViewContainerFactoryInterface;

use function class_exists;
use function class_implements;
use function in_array;
use function is_array;

final class ViewContainerFactoryInstantiator implements ViewContainerFactoryInstantiatorInterface
{
    public function instantiateViewContainerFactory(string $viewContainerFactoryClass): ViewContainerFactoryInterface
    {
        /**
         * Validate view factory
         *
         * $autoload parameter must be "true" in order for this to work.
         */
        if (!class_exists($viewContainerFactoryClass, true)) {
            throw new OutOfRangeException('View factory class does not exist.');
        }
        $interfaces = class_implements($viewContainerFactoryClass, false);
        if (!is_array($interfaces)) {
            throw new UnexpectedValueException('View factory interfaces list is not an array.');
        }
        if (!in_array(ViewContainerFactoryInterface::class, $interfaces, true)) {
            throw new UnexpectedValueException('View factory does not implement required interface.');
        }

        /**
         * Psalm error: "Cannot call constructor on an unknown class".
         *
         * @psalm-suppress MixedMethodCall
         */
        $object = new $viewContainerFactoryClass();

        if (!$object instanceof ViewContainerFactoryInterface) {
            throw new LogicException('Object is not an instance of the required interface.');
        }

        return $object;
    }
}
