<?php

declare(strict_types=1);

namespace Orchid\Filters;

use Orchid\Screen\Field;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var null|array
     */
    public $parameters;

    /**
     * @var bool
     */
    public $display = true;

    /**
     * Current app language.
     *
     * @var string
     */
    public $lang;

    /**
     * The value delimiter.
     *
     * @var string
     */
    protected static $delimiter = ',';

    /**
     * Filter constructor.
     */
    public function __construct()
    {
        $this->request = request();
        $this->lang = app()->getLocale();
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function filter(Builder $builder): Builder
    {
        if (is_null($this->parameters) || $this->request->hasAny($this->parameters)) {
            return $this->run($builder);
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    abstract public function run(Builder $builder): Builder;

    /**
     * @return Field[]
     */
    public function display() : array
    {
        //
    }

    /**
     * @return string
     */
    abstract public function name(): string;

    /**
     * @return string
     */
    public function render() : string
    {
        return collect($this->display())->reduce(function ($html, $field) {
            return (string) $html.$field->form('filters')->render();
        });
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->display());
    }

    /**
     * @return bool
     */
    public function isApply() :bool
    {
        return count($this->request->only($this->parameters, [])) > 0;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        $params = $this->request->only($this->parameters, []);
        $values = collect($params)->flatten()->implode(static::$delimiter);

        return $this->name().': '.$values;
    }

    /**
     * @return string
     */
    public function resetLink(): string
    {
        $params = http_build_query($this->request->except($this->parameters));

        return url($this->request->url().'?'.$params);
    }
}
