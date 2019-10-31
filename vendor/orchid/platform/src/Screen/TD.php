<?php

declare(strict_types=1);

namespace Orchid\Screen;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class TD
{
    use Macroable, CanSee;

    /**
     * Align the cell to the left.
     */
    public const ALIGN_LEFT = 'left';

    /**
     * Align the cell to the center.
     */
    public const ALIGN_CENTER = 'center';

    /**
     * Align the cell to the right.
     */
    public const ALIGN_RIGHT = 'right';

    public const FILTER_TEXT = 'text';
    public const FILTER_NUMERIC = 'numeric';
    public const FILTER_DATE = 'date';

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $width;

    /**
     * @var string
     */
    public $filter;

    /**
     * @var bool
     */
    public $sort;

    /**
     * @var Closure
     */
    public $render;

    /**
     * @var string
     */
    public $column;

    /**
     * @var string
     */
    public $asyncRoute;

    /**
     * @var string
     */
    public $align = 'left';

    /**
     * @var bool
     */
    public $locale = false;

    /**
     * TD constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->column = $name;
    }

    /**
     * @param string $name
     * @param string $title
     *
     * @return TD
     */
    public static function set(string $name, string $title = null): self
    {
        $td = new static($name);
        $td->column = $name;
        $td->title = $title ?? Str::title($name);

        return $td;
    }

    /**
     * @param string $width
     *
     * @return TD
     */
    public function width(string $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Set current columns is multi language.
     *
     * @return TD
     */
    public function locale(): self
    {
        $this->locale = true;

        return $this;
    }

    /**
     * @param string $filter
     *
     * @return TD
     */
    public function filter(string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @param bool $sort
     *
     * @return TD
     */
    public function sort(bool $sort = true): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function handler($data)
    {
        return ($this->render)($data);
    }

    /**
     * @param string $route
     * @param mixed  $options
     * @param string $text
     *
     * @return TD
     */
    public function link(string $route, $options, string $text = null): self
    {
        $this->render(function ($datum) use ($route, $options, $text) {
            $attributes = [];
            $options = Arr::wrap($options);

            foreach ($options as $option) {
                if (method_exists($datum, 'getContent')) {
                    $attributes[] = $datum->getContent($option);
                    continue;
                }

                $attributes[] = $datum->getAttribute($option);
            }

            if (! is_null($text)) {
//                $text = $datum->getContent($text); закомментировано потому что не работает с нынешней архитектурой
                $text = $text ?? '—';
            }

            return view('platform::partials.td.link', [
                'route'      => $route,
                'attributes' => $attributes,
                'text'       => $text,
            ]);
        });

        return $this;
    }

    /**
     * @param Closure $closure
     *
     * @return $this
     */
    public function render(Closure $closure): self
    {
        $this->render = $closure;

        return $this;
    }

    /**
     * @param string       $modal
     * @param string       $method
     * @param string|array $options
     * @param string|null  $text
     *
     * @return TD
     */
    public function loadModalAsync(string $modal, $method, $options, string $text = null): self
    {
        $this->render(function ($datum) use ($modal, $method, $options, $text) {
            $attributes = [];
            $options = Arr::wrap($options);

            foreach ($options as $option) {
                if (method_exists($datum, 'getContent')) {
                    $attributes[] = $datum->getContent($option);
                    continue;
                }

                $attributes[] = $datum->getAttribute($option);
            }

            $text = $datum->getContent($text) ?: $text;

            return view('platform::partials.td.async', [
                'modal'      => $modal,
                'attributes' => $attributes,
                'text'       => $text,
                'method'     => $method,
                'title'      => $this->title,
                'route'      => $this->asyncRoute,
            ]);
        });

        return $this;
    }

    /**
     * @param string $align
     *
     * @return $this
     */
    public function align(string $align): self
    {
        $this->align = $align;

        return $this;
    }

    /**
     * @param string $route
     *
     * @return $this
     */
    public function asyncRoute(string $route): self
    {
        $this->asyncRoute = $route;

        return $this;
    }
}
