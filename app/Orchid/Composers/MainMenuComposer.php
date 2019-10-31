<?php

declare(strict_types=1);

namespace App\Orchid\Composers;

use Orchid\Platform\Menu;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\Dashboard;

class MainMenuComposer
{
    /**
     * @var Dashboard
     */
    private $dashboard;

    /**
     * MenuComposer constructor.
     *
     * @param Dashboard $dashboard
     */
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * Registering the main menu items.
     */
    public function compose()
    {
        // Main
        $this->dashboard->menu
            ->add(Menu::MAIN,
                ItemMenu::label('Главная страница')
                    ->slug('main-page-menu-item')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Бизнес карточки')
                    ->icon('icon-folder')
                    ->route('platform.screens.business.list')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Отзывы')
                    ->icon('icon-folder')
                    ->route('platform.screens.reviews.list')
            )

            ->add(Menu::MAIN,
                ItemMenu::label('Блог')
                    ->slug('blog-page-menu-item')
            )

            ->add(Menu::MAIN,
                ItemMenu::label('Записи')
                    ->icon('icon-folder')
                    ->route('platform.screens.posts.list')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Страницы')
                    ->icon('icon-folder')
                    ->route('platform.screens.pages.list')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Категории')
                    ->icon('icon-folder')
                    ->route('platform.screens.cats.list')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Теги')
                    ->icon('icon-folder')
                    ->route('platform.screens.tags.list')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Комментарии')
                    ->icon('icon-folder')
                    ->route('platform.screens.comments.list')
            );

        // Main
        $this->dashboard->menu
            ->add(Menu::MAIN,
                ItemMenu::label('Настройки')
                    ->slug('settings-page-menu-item')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Меню')
                    ->icon('icon-folder')
                    ->route('platform.screens.menu.list')
            )
            ->add(Menu::MAIN,
                ItemMenu::label('Настройки')
                    ->icon('icon-folder')
                    ->route('platform.screens.settings')
            );
    }
}
