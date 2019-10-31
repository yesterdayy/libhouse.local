import {Controller} from "stimulus";

export default class extends Controller {

    /**
     * @type {string[]}
     */

   /* static targets = [
        "add_array_list_item",
        "remove_array_list_item",
    ];*/

    /**
     *
     */
    /*connect() {
        $(this.element).data('new_index', 0);
    }

    add_array_list_item(event) {
        let new_array_list_item = $(event.target).closest('.multi-array-list-plus').find('.multi-array-list-item-template').clone();
        new_array_list_item.attr('class', 'multi-array-list-item new-list-item');

        $(event.target).closest('.multi-array-list-plus').before(new_array_list_item);
        new_array_list_item.find('.multi-array-list-title').text('Новая миниатюра #' + (parseInt($(this.element).data('new_index')) + 1));
        $(this.element).find('.multi-array-list-item').last().hide().fadeIn(300);

        new_array_list_item.find('.multi-array-list-edit-title').attr('name', new_array_list_item.find('.multi-array-list-edit-title').attr('name').replace('newid', 'new'+$(this.element).data('new_index'))).prop('disabled', false);
        new_array_list_item.find('.multi-array-list-edit-slug').attr('name', new_array_list_item.find('.multi-array-list-edit-slug').attr('name').replace('newid', 'new'+$(this.element).data('new_index'))).prop('disabled', false);

        var that = this;
        new_array_list_item.find('[class^=multi-array-list-edit-parameters]').each(function () {
            $(this).attr('name', $(this).attr('name').replace('newid', 'new'+$(that.element).data('new_index'))).prop('disabled', false);
        });


        $(this.element).data('new_index', parseInt($(this.element).data('new_index')) + 1);
    }

    remove_array_list_item(event) {
        event.preventDefault();
        $(event.target).closest('.multi-array-list-item').fadeOut(300, function () {
            $(this).remove();
        });
    }*/

}