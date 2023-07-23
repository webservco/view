<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use LogicException;
use OutOfRangeException;
use UnexpectedValueException;
use WebServCo\View\Contract\ViewRendererInstantiatorInterface;
use WebServCo\View\Contract\ViewRendererInterface;

use function class_exists;
use function class_implements;
use function in_array;
use function is_array;

final class ViewRendererInstantiator implements ViewRendererInstantiatorInterface
{
    public function instantiateViewRenderer(string $viewRendererClass): ViewRendererInterface
    {
        /**
         * Validate view renderer
         *
         * $autoload parameter must be "true" in order for this to work.
         */
        if (!class_exists($viewRendererClass, true)) {
            throw new OutOfRangeException('View factory class does not exist.');
        }
        $interfaces = class_implements($viewRendererClass, false);
        if (!is_array($interfaces)) {
            throw new UnexpectedValueException('View factory interfaces list is not an array.');
        }
        if (!in_array(ViewRendererInterface::class, $interfaces, true)) {
            throw new UnexpectedValueException('View factory does not implement required interface.');
        }

        /**
         * Magic functionality; no static analysis.
         *
         * Psalm error: "Cannot call constructor on an unknown class".
         *
         * @psalm-suppress MixedMethodCall
         */
        $object = new $viewRendererClass();

        if (!$object instanceof ViewRendererInterface) {
            throw new LogicException('Object is not an instance of the required interface.');
        }

        return $object;
    }
}
