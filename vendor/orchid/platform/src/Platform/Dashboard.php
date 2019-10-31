<?php

declare(strict_types=1);

namespace Orchid\Platform;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Macroable;

class Dashboard
{
    use Macroable;

    /**
     * ORCHID Version.
     */
    public const VERSION = '5.1.1';

    /**
     * The Dashboard configuration options.
     *
     * @var array
     */
    protected static $options = [];

    /**
     * @var Menu
     */
    public $menu;

    /**
     * JS and CSS resources for implementation in the panel.
     *
     * @var Collection
     */
    public $resources;

    /**
     * Permission for applications.
     *
     * @var Collection
     */
    private $permission;

    /**
     * @deprecated use $resources['entities']
     *
     * @var Collection
     */
    private $entities;

    /**
     * @var Collection
     */
    private $globalSearch;

    /**
     * @var Collection
     */
    private $publicDirectories;

    /**
     * Dashboard constructor.
     */
    public function __construct()
    {
        $this->menu = new Menu();
        $this->permission = collect([
            'all'     => collect(),
            'removed' => collect(),
        ]);
        $this->resources = collect();
        $this->entities = collect();
        $this->globalSearch = collect();
        $this->publicDirectories = collect();
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public static function version(): string
    {
        return static::VERSION;
    }

    /**
     * Get the route with the dashboard prefix.
     *
     * @param string $path
     *
     * @return string
     */
    public static function prefix(string $path = ''): string
    {
        $prefix = config('platform.prefix');

        return Str::start($prefix.$path, '/');
    }

    /**
     * Configure the Dashboard application.
     *
     * @param array $options
     *
     * @return void
     */
    public static function configure(array $options)
    {
        static::$options = $options;
    }

    /**
     * Get a Dashboard configuration option.
     *
     * @param string     $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public static function option(string $key, $default = null)
    {
        return Arr::get(static::$options, $key, $default);
    }

    /**
     * @param string      $key
     * @param string|null $default
     *
     * @return mixed
     */
    public static function modelClass(string $key, string $default = null)
    {
        $model = static::model($key, $default);

        return class_exists($model) ? new $model() : $model;
    }

    /**
     * Get the class name for a given Dashboard model.
     *
     * @param string      $key
     * @param null|string $default
     *
     * @return string
     */
    public static function model(string $key, string $default = null)
    {
        return Arr::get(static::$options, 'models.'.$key, $default ?? $key);
    }

    /**
     * @param string $key
     * @param string $custom
     */
    public static function useModel(string $key, string $custom)
    {
        static::$options['models'][$key] = $custom;
    }

    /**
     * Checks if a new and stable version exists.
     *
     * @return bool
     */
    public static function checkUpdate(): bool
    {
        return (new Updates())->check();
    }

    /**
     * @param ItemPermission $permission
     *
     * @return $this
     */
    public function registerPermissions(ItemPermission $permission): self
    {
        if (empty($permission->group)) {
            return $this;
        }

        $old = $this->permission->get('all')
            ->get($permission->group, []);

        $this->permission->get('all')
            ->put($permission->group, array_merge_recursive($old, $permission->items));

        return $this;
    }

    /**
     * @deprecated use Dashboard::macro()
     *
     * @param array $value
     *
     * @return $this
     */
    public function registerEntities(array $value): self
    {
        $this->entities = $this->entities->merge($value);

        return $this;
    }

    /**
     * @param Model[] $value
     *
     * @return $this
     */
    public function registerGlobalSearch(array $value): self
    {
        $this->globalSearch = $this->globalSearch->merge($value);

        return $this;
    }

    /**
     * @param string       $key
     * @param string|array $value
     *
     * @return Dashboard
     */
    public function registerResource(string $key, $value): self
    {
        $item = $this->resources->get($key, []);

        $this->resources[$key] = array_merge($item, Arr::wrap($value));

        return $this;
    }

    /**
     * Return CSS\JS.
     *
     * @param null $key
     *
     * @return array|Collection|mixed
     */
    public function getResource($key = null)
    {
        if (is_null($key)) {
            return $this->resources;
        }

        return $this->resources->get($key);
    }

    /**
     * @deprecated use Dashboard::macro()
     *
     * @return Collection
     */
    public function getEntities(): Collection
    {
        return $this->entities->transform(function ($value) {
            return is_object($value) ? $value : new $value();
        });
    }

    /**
     * @return Collection
     */
    public function getGlobalSearch(): Collection
    {
        return $this->globalSearch->transform(function ($value) {
            return is_object($value) ? $value : new $value();
        });
    }

    /**
     * @return Menu
     */
    public function menu(): Menu
    {
        return $this->menu;
    }

    /**
     * @return Collection
     */
    public function getPermission(): Collection
    {
        $all = $this->permission->get('all');
        $removed = $this->permission->get('removed');

        if (! $removed->count()) {
            return $all;
        }

        return $all->map(function ($group) use ($removed) {
            foreach ($group[key($group)] as $key => $item) {
                if ($removed->contains($item['slug'])) {
                    unset($group[key($group)][$key]);
                }
            }

            return $group;
        });
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function removePermission(string $key) : self
    {
        $this->permission->get('removed')->push($key);

        return $this;
    }

    /**
     * @param string $package
     * @param string $path
     *
     * @return Dashboard
     */
    public function addPublicDirectory(string $package, string $path) : self
    {
        $this->publicDirectories->put($package, $path);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPublicDirectory() : Collection
    {
        return $this->publicDirectories;
    }
}
