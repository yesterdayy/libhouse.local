<?php

namespace App\Models\Blog;

use App\Models\Common\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;
use Orchid\Attachment\File;
use Illuminate\Http\UploadedFile;

class Attachments extends Model
{

    protected $table = 'attachments';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'original_name',
        'mime',
        'extension',
        'size',
        'path',
        'user_id',
        'description',
        'alt',
        'sort',
        'hash',
        'disk',
        'group',
    ];

    protected $guarded = [
        'id',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'url',
        'thumbnails',
    ];


    public static function photoUpload($request, $without_thumbnails = false) {
        if (!$without_thumbnails) {
            if (empty($image_sizes)) {
                $image_sizes = config('filesystems.thumbnails_size');
            }
        }

        $attachment = [];
        foreach ($request->allFiles() as $files) {
            $files = Arr::wrap($files);

            foreach ($files as $file) {
                $attachment[] = self::createModel($file, $request);
                $curfile = last($attachment);

                if (!in_array($curfile->extension, ['jpg', 'jpeg', 'png'])) {
                    continue;
                }

                if (!$without_thumbnails) {
                    // Создаем миниатюры
                    if ($image_sizes) {
                        foreach ($image_sizes as $image_size) {
                            $image_size = $image_size['value'];
                            $ext = 'jpg';
                            $path = public_path() . '/storage/' . $curfile->path;
                            Image::make($file)->encode('jpg')->fit($image_size[0], $image_size[1])->pixelate(16)->save($path . $curfile->name . '_' . implode('_', $image_size) . '_preload.' . $ext, 25);
                            Image::make($file)->encode('jpg')->fit($image_size[0], $image_size[1])->save($path . $curfile->name . '_' . implode('_', $image_size) . '.' . $ext, 80);
                        }
                    }
                }
            }
        }

        $attachment = count($attachment) > 1 ? $attachment : reset($attachment);

        return $attachment;
    }

    public static function avatarUpload($request) {
        $image_sizes = [[150, 150]];
        $attachment = [];
        foreach ($request->allFiles() as $files) {
            $files = Arr::wrap($files);

            foreach ($files as $file) {
                $attachment[] = self::createModel($file, $request);

                // Создаем миниатюры
                if ($image_sizes) {
                    $curfile = last($attachment);
                    foreach ($image_sizes as $image_size) {
                        $ext = 'jpg';
                        $path = public_path() . '/storage/' . $curfile->path;
                        Image::make($file)->encode('jpg')->fit($image_size[0], $image_size[1])->save($path . $curfile->name . '.' . $ext, 80);
                    }
                }
            }
        }

        $attachment = count($attachment) > 1 ? $attachment : reset($attachment);

        return $attachment;
    }

    public function url($default = null): ?string
    {
        $disk = $this->getAttribute('disk');

        if (Storage::disk($disk)->exists($this->physicalPath())) {
            return Storage::disk($disk)->url($this->physicalPath());
        }

        return $default;
    }

    public function thumbnails_url(): ?array
    {
        $disk = $this->getAttribute('disk');

        $thumbs = null;

        $thumbs_urls = config('filesystems.thumbnails_size');

        foreach ($thumbs_urls as $thumb) {
            if (Storage::disk($disk)->exists($this->physicalPath())) {
                $thumbname = $thumb['value'][0] . '_' . $thumb['value'][1];
                $thumbs[$thumb['slug']] = Storage::disk($disk)->url($this->physicalPath($thumbname));
            }
        }

        return $thumbs;
    }

    /**
     * @return string
     */
    public function physicalPath($thumb = null): string
    {
        $thumb = $thumb ? '_' . $thumb : null;
        return $this->path.$this->name.$thumb.'.'.$this->extension;
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->url();
    }

    /**
     * @return string
     */
    public function getThumbnailsAttribute()
    {
        return $this->thumbnails_url();
    }

    /**
     * @param UploadedFile $file
     * @param Request $request
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */

    private static function createModel(UploadedFile $file, Request $request)
    {
        $model = app()->make(File::class, [
            'file'  => $file,
            'disk'  => $request->get('storage', 'public'),
            'group' => $request->get('group'),
        ])->load();

        $model->url = $model->url();

        return $model;
    }

}
