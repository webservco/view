<?php

declare(strict_types=1);

namespace WebServCo\View\Service;

use OutOfBoundsException;
use UnexpectedValueException;
use WebServCo\View\Contract\ViewContainerInterface;
use WebServCo\View\Contract\ViewInterface;
use WebServCo\View\Contract\ViewRendererInterface;

use function is_file;
use function is_readable;
use function ob_end_clean;
use function ob_get_contents;
use function ob_start;

/**
 * An abstract View renderer using template files.
 */
abstract class AbstractTemplateViewRenderer implements ViewRendererInterface
{
    /**
     * Render view using a file template.
     *
     * POC: https://3v4l.org/UFDQl#v8.2.1
     * Not tied to HTML or any other language, the template can contain anything.
     * The actual content type of the output is decied in the implementing classes
     * by using the getContentType
     * Eg. a HTMLRenderer will be fed template files that would produce HTML output and use a 'text/html' content type.
     * Note: $viewContainer would be directly available in the template file.
     * To avoid this we will be using a separate method to actually render the output.
     */
    public function render(ViewContainerInterface $viewContainer): string
    {
        return $this->renderView($viewContainer->getView(), $viewContainer->getTemplatePath());
    }

    /**
     * Render view.
     *
     * Suppress static analysis "unused parameter" errors.
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     * @suppress PhanUnusedPrivateMethodParameter
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    private function renderView(ViewInterface $view, string $templatePath): string
    {
        if (!is_readable($templatePath)) {
            throw new OutOfBoundsException('Template path not readable.');
        }
        if (!is_file($templatePath)) {
            throw new UnexpectedValueException('Template path is not a file.');
        }

        try {
            // "Turn on output buffering".
            $result = ob_start();
            if ($result === false) {
                throw new UnexpectedValueException('Error turning on output buffering.');
            }

            // Note: do not use _once here, the same template can be used multiple times.
            require $templatePath;
            $output = ob_get_contents();
            if ($output === false) {
                throw new UnexpectedValueException('Output buffering is not active.');
            }

            return $output;

            // No catch block, the exception will "bubble up".
        } finally {
            // "Clean (erase) the output buffer and turn off output buffering".
            ob_end_clean();
        }
    }
    // @phpcs:enable
}
