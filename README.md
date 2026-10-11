# webservco/view

A PHP component/library. Please see [webservco/sandbox](https://webservco.github.io/sandbox/) for an example project using these types of components.

Views, PHP templates and renderers that turn a view into HTML, JSON or JSON:API.

- Related: `webservco/controller` (creates views and renders them), `webservco/middleware` (picks the renderer from the `Accept` header)

---

## Installation

```shell
composer require webservco/view
```

---

## Usage

### A view

A view is a readonly object that holds the data for one template. Extend `AbstractView` to get `escape()`.

```php
use WebServCo\View\View\AbstractView;

final class TestView extends AbstractView
{
    public function __construct(public readonly int $intProperty, public readonly ?string $stringProperty)
    {
    }
}
```

### The template

A PHP file, where `$view` is the view object:

```php
<?php

declare(strict_types=1);

assert(isset($view) && $view instanceof TestView);
?>
<div>
    String property: <?=$view->escape($view->stringProperty)?>
    Int property: <?=$view->intProperty?>
</div>
```

Controllers combine the two with `ViewContainerFactory::createViewContainerFromView($view, 'example/test')` (see `webservco/controller`). The HTML renderer includes the template, and the JSON renderer encodes the view's public properties.

---

## Contracts

| Interface | Implementation | Purpose |
| --- | --- | --- |
| `Contract\ViewInterface` | `View\AbstractView`, `View\MainView`, `View\CommonView` | View data. `MainView` wraps the rendered page for the layout. |
| `Contract\ViewContainerInterface` | `Service\ViewContainer` | A view with its template name. |
| `Contract\ViewContainerFactoryInterface` | `Factory\ViewContainerFactory` | Creates view containers. |
| `Contract\HTMLRendererInterface` | `Service\HTMLRenderer` | Renders a PHP template (`text/html`). |
| `Contract\JSONRendererInterface` | `Service\JSONRenderer` | `json_encode()` of the view (`application/json`). |
| `Contract\JSONAPIRendererInterface` | `Service\JSONAPIRenderer` | Same, as `application/vnd.api+json`. |
| `Contract\TemplateServiceInterface` | `Service\TemplateService` | Template directory and file suffix. |
| `Contract\ViewRendererResolverInterface` | `Service\ViewRendererResolver` | Picks a renderer from the ones a handler supports. |
| `Contract\ViewServicesContainerInterface` | `Service\ViewServicesContainer` | View container factory plus the chosen renderer, given to controllers. |

Namespaces are relative to `WebServCo\View\`.

---

## Notes

`escape()` is for HTML output. Use it on every value that comes from users, because templates print exactly what they're given.

The resolver uses the renderer set by `ViewRendererSettingMiddleware`. When the client accepts anything (`*/*`), it takes the first renderer the handler lists. Order that list by preference.

Templates are plain PHP files and are checked by the static analysers like any other code. Start each one with an `assert()` on `$view` so the tools know its type.

---

## Development

```shell
# Start project.
ddev start
# Install dependencies.
ddev c u
# Run all validations.
ddev c c
# Run unit tests.
ddev c test:dox
```

---

## License

[MIT](LICENSE.md)
