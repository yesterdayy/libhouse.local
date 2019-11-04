/**
 * plugin.js
 *
 * Copyright, Alberto Peripolli
 * Released under Creative Commons Attribution-NonCommercial 3.0 Unported License.
 *
 * Contributing: https://github.com/trippo/ResponsiveFilemanager
 */

tinymce.PluginManager.add('yesimgmanager', function(editor) {
// Add a button that opens a window
    editor.addButton('example', {
        text: 'My button',
        icon: false,
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Медиафайлы',
                body: [
                    {type: 'textbox', name: 'title', label: 'Title'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('Title: ' + e.data.title);
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('example', {
        text: 'Медиафайлы',
        context: 'tools',
        onclick: function() {
            // Open window with a specific url
            editor.windowManager.open({
                title: 'Медиафайлы',
                html: '<h1>TEST</h1>',
                width: 800,
                height: 600,
                buttons: [{
                    text: 'Close',
                    onclick: 'close'
                }]
            });
        }
    });

    return {
        getMetadata: function () {
            return  {
                name: "Медиафайлы",
                url: "http://exampleplugindocsurl.com"
            };
        }
    };
});
