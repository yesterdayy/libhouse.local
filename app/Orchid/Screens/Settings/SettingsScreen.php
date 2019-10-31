<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Common\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Fields\ArrayInput;
use Orchid\Screen\Fields\MultiArrayInput;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\PictureUpload;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layout;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class SettingsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Настройки';
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @param Settings $settings
     *
     * @return array
     */
    public function query(Settings $settings = null): array
    {
        return [
            'settings' => $settings,
        ];
    }

    /**
     * Button commands.
     *
     * @return array
     */
    public function commandBar(): array
    {
        return [
            Link::name(__('Save'))
                ->icon('icon-check')
                ->method('save'),

            Link::name(__('Remove'))
                ->icon('icon-trash')
                ->method('remove'),
        ];
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        $layout_tab_main = [
            Layout::columns([
                Layout::rows([
                    Input::make('main.title')
                        ->type('text')
                        ->max(255)
                        ->value(\App\Models\Common\Settings::get('title'))
                        ->title(__('Название сайта')),

                    Input::make('main.title_header')
                        ->type('text')
                        ->max(255)
                        ->value(\App\Models\Common\Settings::get('title_header'))
                        ->title(__('Logo Text')),
                ]),
            ]),
        ];

        $layout_tab_thumbnails = [];
        $layout_tab_thumbnails[] = Layout::rows([
            MultiArrayInput::make('thumbnails.thumbnails_size')
            ->value(\App\Models\Common\Settings::getUnserialize('thumbnails_size'))
            ->labels(['Ширина', 'Высота'])
        ]);

        $layout_tab_blog = [
            Layout::columns([
                Layout::rows([
                    Switcher::make('blog.comments_moderation')
                        ->title('Модерация комментариев (вкл / выкл)')
                        ->value(\App\Models\Common\Settings::get('comments_moderation', 0))
                        ->sendTrueOrFalse(true)
                ]),
            ]),
        ];

        $layout_tab_contacts = [
            Layout::columns([
                Layout::rows([
                    Input::make('contacts.phone')
                        ->type('text')
                        ->max(255)
                        ->value(\App\Models\Common\Settings::get('phone'))
                        ->title(__('Номер телефона')),

                    ArrayInput::make('contacts.payment_details')
                        ->value(\App\Models\Common\Settings::getUnserialize('payment_details'))
                        ->title(__('Реквизиты')),

                    Input::make('contacts.admin_link')
                        ->type('text')
                        ->max(255)
                        ->value(\App\Models\Common\Settings::get('admin_link'))
                        ->title(__('Ссылка на администратора')),
                ]),
            ]),
        ];

        $layout = [
            Layout::tabs([
                'Основные настройки' => $layout_tab_main,
                'Миниатюры' => $layout_tab_thumbnails,
                'Блог' => $layout_tab_blog,
                'Контакты' => $layout_tab_contacts,
            ])
        ];

        return $layout;
    }

    /**
     * @param Settings $settings
     * @param Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Settings $settings, Request $request)
    {
        // Обрабатываем вкладку Основная
        $main = $request->get('main');
        foreach ($main as $key => $value) {
            $value = is_array($value) ? serialize($value) : $value;
            Settings::set($key, $value);
        }
        unset($key, $value);

        // Обрабатываем вкладку Миниатюры
        $thumbails = $request->get('thumbnails')['thumbnails_size'];

        // Обновляем Миниатюры
        $thumbails_new = [];
        foreach ($thumbails as $key => $thumbail) {
            if (strpos($key, 'new') !== false) {
                foreach ($thumbail as $new_item) {
                    $thumbails_new[$new_item['slug']] = $new_item;
                }
            } else {
                $thumbails_new[$thumbail['slug']] = $thumbail;
            }
        }
        Settings::set('thumbnails_size', serialize($thumbails_new));

        // Обрабатываем вкладку Блог
        $blog = $request->get('blog');
        foreach ($blog as $key => $value) {
            $value = is_array($value) ? serialize($value) : $value;
            Settings::set($key, $value);
        }
        unset($key, $value);

        // Обрабатываем вкладку Контакты
        $contacts = $request->get('contacts');
        foreach ($contacts as $key => $value) {
            $value = is_array($value) ? serialize($value) : $value;
            Settings::set($key, $value);
        }
        unset($key, $value);

        Alert::info(__('Settings was saved'));

        return redirect()->route('platform.screens.settings', $settings->id);
    }

}
