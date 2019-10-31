import {Controller} from "stimulus";

export default class extends Controller {

    /**
     * @type {string[]}
     */

    static targets = [
        "toggle_menu_item",
        "add_menu_item",
        "remove_menu_item",
    ];

    parent_class = '.menu-list-item';
    link_class = '.menu-list-link';

    /**
     *
     */
    connect() {
        var elem = this.element;
        $(this.element).data('new_index', 0);
        this.dragula_init();

        var select = $('.menu-list-item select', this.element);
        this.select2_init(select);
    }

    dragula_init() {
        var elem = this.element;
        let unique_id = Math.random().toString(36).substr(2, 9);
        $(this.element).data('unique-id', unique_id);
        window['dragula' + unique_id] = dragula([elem]).on('drop', function (el, container) {
            // const formData = new FormData();
            // formData.append('form_id', $(elem).attr('data-menu'));
            //
            // if ($(el).hasClass('new-list-item')) {
            //     $(el).find('.menu-list-edit-order').val($(el).index());
            // }
            //
            $('.menu-list-item', elem).each(function () {
                $('.menu-list-edit-order', this).val($(this).index());
                // formData.append('order['+$(this).attr('data-id')+']', $(this).index());
            })
            //
            // axios.post(platform.prefix('/menu/order'), formData)
            //     .then((response) => {
            //
            //     });
        });
        window['dragula' + $(elem).data('unique-id')].emit('drop');
    }

    toggle_menu_item(event) {
        $(event.target).closest('.menu-list-item').toggleClass('active');
        $(event.target).closest('.menu-list-item').find('.menu-list-edit').slideToggle();
    }

    add_menu_item(event) {
        let new_menu_item = $(event.target).closest('.menu-list-plus').find('.menu-list-plus-item .menu-list-item-template').clone();
        new_menu_item.attr('data-id', 'new'+$(this.element).data('new_index'));
        new_menu_item.attr('class', 'menu-list-item new-list-item');

        new_menu_item.find('.menu-list-edit-title').val('Новый пункт меню ' + $(this.element).data('new_index'));
        new_menu_item.find('.menu-list-edit-title').attr('name', new_menu_item.find('.menu-list-edit-title').attr('name').replace('newid', 'new'+$(this.element).data('new_index'))).prop('disabled', false);
        new_menu_item.find('.menu-list-link').attr('name', new_menu_item.find('.menu-list-link').attr('name').replace('newid', 'new'+$(this.element).data('new_index'))).prop('disabled', false);
        new_menu_item.find('.menu-list-edit-icon').attr('name', new_menu_item.find('.menu-list-edit-icon').attr('name').replace('newid', 'new'+$(this.element).data('new_index'))).prop('disabled', false);
        new_menu_item.find('.menu-list-edit-class').attr('name', new_menu_item.find('.menu-list-edit-class').attr('name').replace('newid', 'new'+$(this.element).data('new_index'))).prop('disabled', false);
        new_menu_item.find('.menu-list-edit-order').attr('name', new_menu_item.find('.menu-list-edit-order').attr('name').replace('newid', 'new'+$(this.element).data('new_index'))).prop('disabled', false);
        this.select2_init(new_menu_item.find('select'));

        $(event.target).closest('.menu-list-plus').before(new_menu_item);
        $(this.element).find('.menu-list-item').last().hide().fadeIn(300)

        $(this.element).data('new_index', parseInt($(this.element).data('new_index')) + 1);
        window['dragula' + $(this.element).data('unique-id')].emit('drop');
    }

    remove_menu_item(event) {
        event.preventDefault();
        var elem = this.element;
        $(event.target).closest('.menu-list-item').fadeOut(300, function () {
            if ($(this).hasClass('new-list-item')) {
                $(this).remove();
            } else {
                $(this).addClass('removed');
                $('input', this).attr('name', $('input', this).attr('name').replace($(this).attr('data-id'), 'delete_' + $(this).attr('data-id')));
                $(this).insertAfter($('.menu-list-plus', elem))
            }
            window['dragula' + $(elem).data('unique-id')].emit('drop');
        });
    }

    select2_init(select) {
        var that = this;
        $(select).select2({
            theme: 'bootstrap',
            templateResult: (state) => {
                if (!state.id || !state.count) {
                    return state.text;
                }
                return $(`<span>${state.text}</span><span class="pull-right badge bg-info">${state.count}</span>`);
            },
            escapeMarkup(m) {
                return m;
            },
            width: '100%',
            cache: true,
            ajax: {
                url(params) {
                    return platform.prefix(`/menu/search/${params.term}`);
                },
                delay: 340,
                processResults(data) {
                    return {
                        results: data,
                    };
                },
            },
        })
            .on('select2:select', function (e) {
                let data = e.params.data;
                if (data.slug.length > 0) {
                    let slug = data.slug;
                    console.log($(e.target));
                    console.log(that.parent_class, that.link_class);
                    $(e.target).closest(that.parent_class).find(that.link_class).val(slug);
                }
            });
    }

}