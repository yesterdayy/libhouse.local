<?php

declare(strict_types=1);

namespace App\Orchid\Entities;

use Orchid\Screen\TD;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Map;
use Orchid\Screen\Fields\UTM;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\Tags;
use Orchid\Press\Entities\Many;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Press\Models\Category;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\SimpleMDE;
use Illuminate\Database\Eloquent\Model;
use Orchid\Press\Http\Filters\SearchFilter;
use Orchid\Press\Http\Filters\StatusFilter;
use Orchid\Press\Http\Filters\CreatedFilter;

class Posts extends Many
{
    /**
     * @var string
     */
    public $name = 'Example post';

    /**
     * @var string
     */
    public $description = 'Demonstrative post';

    /**
     * @var string
     */
    public $slug = 'example';

    /**
     * Slug url /news/{name}.
     *
     * @var string
     */
    public $slugFields = 'name';

    /**
     * Menu group name.
     *
     * @var null
     */
    public $groupname = 'Common Posts';

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Model $model) : Model
    {
        return $model;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function save(Model $model)
    {
        //
    }

    /**
     * Rules Validation.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
//            'id'             => 'sometimes|integer',
//            'content.*.name' => 'required|string',
//            'content.*.body' => 'required|string',
        ];
    }

    /**
     * HTTP data filters.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
//            StatusFilter::class,
//            SearchFilter::class,
//            CreatedFilter::class,
        ];
    }

    /**
     * @throws \Throwable|\Orchid\Screen\Exceptions\TypeException
     *
     * @return array
     */
    public function fields(): array
    {
        return [

        ];
    }

    /**
     * @throws \Orchid\Screen\Exceptions\TypeException
     * @throws \Throwable
     *
     * @return array
     */
    public function main(): array
    {
        return array_merge(parent::main(), [

        ]);
    }

    /**
     * @throws \Throwable
     *
     * @return array
     */
    public function options(): array
    {
        return [

        ];
    }

    /**
     * Grid View for post type.
     */
    public function grid(): array
    {
        return [

        ];
    }
}
