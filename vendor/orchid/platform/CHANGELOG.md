# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 5.1.1 - 2019-06-20

### Added
- Check method for Alert

### Deprecated
- ItemMenu method `show` use `canSee`

### Fixed
- Relation field null search string [894](https://github.com/orchidsoftware/platform/pull/894)

## 5.1.0 - 2019-06-17

### Added
- View template for Alert [892](https://github.com/orchidsoftware/platform/issues/892)

## 5.0.5 - 2019-06-16

### Added
- Relation field method `fromClass` [888](https://github.com/orchidsoftware/platform/pull/888)
- TimeZone field [890](https://github.com/orchidsoftware/platform/issues/890)

### Fixed
- Relation field [893](https://github.com/orchidsoftware/platform/issues/893)

## 5.0.4 - 2019-06-11

### Fixed
- Setting rewrite cache keys

## 5.0.3 - 2019-06-09

### Added
- Read only for `Qill` field
- Placeholder for `Qill` field
- Ability to publish migration files

## 5.0.2 - 2019-06-08

### Added
- Read only for `Code` field
- Language supported constants for `Code` field

## 5.0.1 - 2019-06-08

### Fixed
- Remove permission registration for comments and category [880](https://github.com/orchidsoftware/platform/issues/880)
- Needed permissions to roles and users screens [884](https://github.com/orchidsoftware/platform/issues/884)
- Redirect after authorization has been changed to the main page

## 5.0.0 - 2019-06-02

### Added
- `Cropper` method `targetUrl`, `targetRelativeUrl`, `targetId` [850](https://github.com/orchidsoftware/platform/issues/850)
- `Upload` field takes array of numeric values [851](https://github.com/orchidsoftware/platform/issues/851)
- Property `name` for `Filter`
- `TD` method `canSee`
- Auto substitution from previous session [824](https://github.com/orchidsoftware/platform/issues/824)
- Select lazyload multiple [772](https://github.com/orchidsoftware/platform/issues/772)

### Changed
- Rename `Picture` field to `Cropper`
- Redesigned structure blade templates

### Fixed
- Use checkbox in table [874](https://github.com/orchidsoftware/platform/issues/874)
- Filter trigger by many parameter
- Safari not send form [864](https://github.com/orchidsoftware/platform/issues/864)

### Removed
-  Move package for `Press` in a separate repository [815](https://github.com/orchidsoftware/platform/issues/815)
- `Orchid\Dashboard\ItemMenu::groupName()` use `title` method [842](https://github.com/orchidsoftware/platform/issues/842)
- `Entity` property `groupname` use `title` [842](https://github.com/orchidsoftware/platform/issues/842)
- `Orchid\Platform\Filters\*` use `Orchid\Filters\*`
- `AttachTrait` use `Orchid\Attachment\Attachable`
- `FilterTrait` use `Orchid\Filters\Filterable`
- Sluggable package
- Widget package

## 4.7.1 - 2019-04-24

### Added
- Trait `AsSource.php` for Eloquent model 
- Only time for `DateTimer` field

### Fixed
- Avatar jumping when refreshing page

## 4.7.0 - 2019-04-22

### Added
- Method `filtersApplySelection` for all filter in selection

## 4.6.3 - 2019-04-21

### Added
- `Empty` method Allowing  value to the sample for the default operation (usually empty) [839](https://github.com/orchidsoftware/platform/pull/839)

### Changed
- Documentation move [repository website](https://github.com/orchidsoftware/orchid.software)

### Deprecated
- `Orchid\Dashboard\ItemMenu::groupName()` use `title` method [842](https://github.com/orchidsoftware/platform/issues/842)
- `Entity` property `groupname` use `title` [842](https://github.com/orchidsoftware/platform/issues/842)

## 4.6.2 - 2019-04-19

### Changed
- Chart min heating auto
- Cache browser views

### Fixed
- Repeated run test to create resource links
- Http sorting for allow property
- Http request problem, to remove '/' [from last path of the url](https://stackoverflow.com/a/47478891).
- Input mask is null or empty, cant not type japanese character.
- When the resource has the same name with another extension.

### Deprecated
- `Orchid\Platform\Filters\*` use `Orchid\Filters\Filter\*`
- `AttachTrait` use `Orchid\Attachment\Attachable`
- `FilterTrait` use `Orchid\Filters\Filterable`

## 4.6.1 - 2019-04-16

### Changed
- Reload template for profile for back history

### Fixed
- Icon for accordion
- Double defined time controller
- Injected SQL for Spatie builder

## 4.6.0 - 2019-04-15

### Added
- `Layout::accordion` [834](https://github.com/orchidsoftware/platform/pull/834)

## 4.5.1 - 2019-04-13

### Fixed
- Custom auth

## 4.5.0 - 2019-04-12

### Added
- `Layout::wrapper` [827](https://github.com/orchidsoftware/platform/pull/827)

### Changed
- `Layouts` class rename to `Layout` [833](https://github.com/orchidsoftware/platform/issues/833) 
- Login/Registration page
- The color scheme has become more neutral [815](https://github.com/orchidsoftware/platform/issues/815)

### Fixed
- Uncaught ReferenceError: `platform` is not defined

## 4.4.4 - 2019-03-26

### Added
- User filter for foles [823](https://github.com/orchidsoftware/platform/pull/823)

## 4.4.3 - 2019-03-25

### Fixed
- Error in select field [822](https://github.com/orchidsoftware/platform/pull/822)
- Padding for columns

## 4.4.2 - 2019-03-24

### Fixed
- Revert [821](https://github.com/orchidsoftware/platform/pull/821)

## 4.4.1 - 2019-03-23

### Fixed
- Error in select field [821](https://github.com/orchidsoftware/platform/pull/821)
- `DataTime` method enableTime [820](https://github.com/orchidsoftware/platform/pull/820)

## 4.4.0 - 2019-03-22

### Changed
- Color scheme, no more brand color
- Padding for layouts

### Fixed
- Entity sorting default
- `DataTime` method enableTime [816](https://github.com/orchidsoftware/platform/issues/816)

### Removed
- All dependency
- `Cache` block [810](https://github.com/orchidsoftware/platform/issues/810)

## 4.3.4 - 2019-03-17

### Added
- Button field [807](https://github.com/orchidsoftware/platform/issues/807)

### Changed
- Rename `setLabel` to `label` for Collapse

### Fixed
- Show text for `Label` field

### Deprecated
- `set` prefix for ItemMenu, ItemPermission, TD [809](https://github.com/orchidsoftware/platform/issues/809)

## 4.3.3 - 2019-03-15

### Fixed
- Fix for where `attchments` argument group

## 4.3.2 - 2019-03-14

### Fixed
- Fix for command's bar link [806](https://github.com/orchidsoftware/platform/pull/806)

## 4.3.1 - 2019-03-13

### Added
- Missing translation

## 4.3.0 - 2019-03-13

### Added
- Collapse layouts
- Animation for submit button

### Changed
- Entity no longer has a default icon
- Improved interaction experience on mobile devices 
- Modals not require route name
- Remove "close" button for menu
- Rename "reset" button menu as "close"

### Fixed
- Send post request for create menu element
- Icon for `Password` field
- Entities show activity
- Dublicate cache for TinyMCE field

### Removed
- Remove dependency `spomky-labs/base64url`

## 4.2.0 - 2019-03-10

### Added
- Source modify value for select [798](https://github.com/orchidsoftware/platform/issues/798#issuecomment-471326038)
- Options for show/hidden password [801](https://github.com/orchidsoftware/platform/issues/801)

### Fixed
- Change password for default screen 

### Deprecated
- Method `getStatusRoles()` for User model

## 4.1.1 - 2019-03-10

### Fixed
- Relationship nullable [797](https://github.com/orchidsoftware/platform/issues/797)
- DateRange not send value

## 4.1.0 - 2019-03-09

### Added
- Event for install orchid [795](https://github.com/orchidsoftware/platform/issues/795)
- Source for select [798](https://github.com/orchidsoftware/platform/issues/798)
- Method for control date time [794](https://github.com/orchidsoftware/platform/issues/794)

### Fixed
- Return exception message for create admin command [796](https://github.com/orchidsoftware/platform/issues/796)

## 4.0.1 - 2019-03-04

### Fixed
- Laravel user `bigInteger` id
- Load factory only test

## 4.0.0 - 2019-03-03

### Added
- Export metrics button
- Support laravel 5.8
- Support phpunit 8.0
- Added tips for phpdoc

### Changed
- By default, the panel is available from any domain.
- Remove postfix `Field` for all
- The context of the routes has been changed to `$this->router`. 
Due to changes in the framework, you can also use the structure through the facade `Route::get`.
- Reworked layer display engine

### Removed
- `dashboard_domain` helper
- Media [780](https://github.com/orchidsoftware/platform/issues/780)
- Deprecated params to `->setRoute(route('platform.*'))` for menu
- `Dashboard::registerPermissions` accept array argument

## 3.11.0 - 2019-02-25

### Added
- New field RadioButtonsField

### Fixed
- Multiple heritage activity in the menu

## 3.10.6 - 2019-02-25

### Changed
- Display permission for hidden entity
- Auto set active for menu
- Set default Icon for menu
- Default `true` params for childs menu

## 3.10.5 - 2019-02-25

### Changed
- Padding sub-element menu

## 3.10.4 - 2019-02-25

### Changed
- ItemMenu allow array or string with `setActive` method
- Colors for pagination
- Unification of button colors
- If a submenu is declared, then activation will come from the child elements.

### Fixed
- Padding for numeric filter
- Drop test when displaying prohibited characters

## 3.10.3 - 2019-02-22

### Changed
- Display error pages

### Fixed
- 405 Method Not Allowed for Ajax
- Positioning buttons in password recovery forms

### Deprecated
- params to `->setRoute(route('platform.*'))`
  This method will be saved, but will explicitly respond to its name.
  If you want to create links otherwise use `->setUrl()`

## 3.10.1 - 2019-02-22

### Fixed
- Disabled preview for turbolinks

## 3.10.0 - 2019-02-22

### Added
- Macros for TD [785](https://github.com/orchidsoftware/platform/issues/785)

### Changed
- Removed links for welcome template [786](https://github.com/orchidsoftware/platform/issues/786)
- Enabled cache for turbolinks
- Chart not responsive

### Fixed
- Modal not open PictureField [787](https://github.com/orchidsoftware/platform/issues/787)
- Error for resize event 
- Route cache not register route

## 3.9.6 - 2019-02-15

### Changed
- Revert command `orchid:link` for symlink resource

## 3.9.5 - 2019-02-14

### Changed
- Turbolink no-cache all page
- Removed years for license

### Fixed
- Update `csrf` token

### Deprecated
- `Dashboard::registerPermissions` accept array argument

## 3.9.4 - 2019-02-14

### Changed
- Jquery-ui replace sortablejs

### Fixed
- Chart not remove event see https://github.com/frappe/charts/issues/212
- Remove mask for submit

## 3.9.3 - 2019-02-13

### Changed
- Basic forms now use AJAX

### Fixed
- Validation form responsive
- Submit form event [783](https://github.com/orchidsoftware/platform/issues/783)

## 3.9.2 - 2019-02-11

### Added
- Ajax for base screen form

### Fixed
- Original name edit attachment

## 3.9.1 - 2019-02-11

### Fixed
- Load tinyMCE theme

## 3.9.0 - 2019-02-10

### Changed
- Laravel Scout upgrade to ^7.0
- Route `platform.resource` has a panel prefix

### Fixed
- Show model animate [778](https://github.com/orchidsoftware/platform/issues/778)

### Removed
- Backups as a package [769](https://github.com/orchidsoftware/platform/issues/769)
- Builder as package [770](https://github.com/orchidsoftware/platform/issues/770)

## 3.8.1 - 2019-02-09

### Fixed
- Install rewrite user model [777](https://github.com/orchidsoftware/platform/issues/777)

## 3.8.0 - 2019-02-07

### Added
- Route `platform.resource` for static file from package
- Register `public` directory for packages `addPublicDirectory` and `getPublicDirectory`
- Function `orchid_mix` for packages

### Fixed
- Route cache closure

### Removed
- Command `orchid:link`
- Method for clear opcache

## 3.7.5 - 2019-02-04

### Fixed
- Redirect entity for save

### Removed
- dependency `composer/semver`

## 3.7.4 - 2019-02-03

### Changed
- Menus can no longer be filled with an array.

### Fixed
- Sorting with nesting attachment

## 3.7.3 - 2019-02-02

### Changed
- Color palette, indents of elements and minor edits
- The image field no longer supports additional features.

### Fixed
- Opening file information in modal window

## 3.7.2 - 2019-02-01

### Fixed
- Correct slug (id) generation for the input field
- Fixed rights verification in the screen when the value of the array

## 3.7.1 - 2019-01-31

### Fixed
- Entity route generator

## 3.7.0 - 2019-01-28

### Changed
- Entities have been transferred to use screens [721](https://github.com/orchidsoftware/platform/issues/721)

### Fixed
- The order of dependencies and their types returns incorrect values ​​in the screens

## 3.6.2 - 2019-01-24

### Fixed
- Can't use registerResource in package [765](https://github.com/orchidsoftware/platform/issues/765)

### Removed
- DashboardServiceProvider

## 3.6.1 - 2019-01-19

### Fixed
- Margin menu

## 3.6.0 - 2019-01-19

### Added
- New Switches fields

### Changed
- Footer is now pressed to the bottom of the page
- The free area between the menu and the footer is the "Up" button

## [3.5.1] - 2019-01-18

### Fixed
- Help string for horizontal form
- Model builder relations

## [3.5.0] - 2019-01-16

### Added
- Field method `canSee` [759](https://github.com/orchidsoftware/platform/pull/759)

### Changed
- Link method `show` rename `canSee` [759](https://github.com/orchidsoftware/platform/pull/759)

### Removed
- Link method `show` [759](https://github.com/orchidsoftware/platform/pull/759)

## [3.4.2] - 2019-01-13

### Changed
- Rename `TypeException` to `EntityTypeException`

### Removed
- Unused `registerFiled` and `getField` for Dashboard

## [3.4.1] - 2019-01-12

### Fixed
- Removed unnecessary foreach in selection.blade.php [758](https://github.com/orchidsoftware/platform/pull/758)

## [3.4.0] - 2019-01-11

### Added
- Date ranged field
- TD align constant
- Selection layout for filters [753](https://github.com/orchidsoftware/platform/issues/753)

### Changed
- Filters can no longer view

### Removed
- Filter property `$dashboard`
- Filters for table

### Fixed
- Correct tips for Field

## [3.3.4] - 2018-12-31

### Changed

- Acync modal & User table edit

## [3.3.3] - 2018-12-27

### Changed

- MapField autoscroll [755](https://github.com/orchidsoftware/platform/pull/755)

### Removed

- Method `hero` for Post Models

## [3.2.2] - 2018-12-24

### Fixed
- UploadField multiple upload file

## [3.2.1] - 2018-12-23

### Fixed
- Collection by default not set keys, mixed items unpredictable. [752](https://github.com/orchidsoftware/platform/pull/752)

## [3.2.0] - 2018-12-22

### Changed
- Rename `Demo` to `Example` entity

### Removed
- The modal support service window has been removed in favor of creating custom forms, since the set of fields and the template could not be changed

## [3.1.8] - 2018-12-22

### Added
- Attributes rel="noopener" for target "_blank"

### Removed
- Divider for entities because visually does not share

## [3.1.7] - 2018-12-17

### Fixed
- Publish `PressServiceProvider` files during installation

## [3.1.6] - 2018-12-14

### Added
- Attribute `height` for Quill / TinyMCE / Map / Code Fields

### Removed
- User localization column

## [3.1.5] - 2018-12-12

### Fixed
- Publish `PressServiceProvider` files during installation

## [3.1.4] - 2018-12-09

### Added
- Global variable `Controller`

### Removed
- Unused Image package dependency
- Unused `JsonRelationsTrait`

## [3.1.3] - 2018-12-06

### Deprecated
- JsonRelationsTrait

### Removed
- Attachment method `read`

## [3.1.2] - 2018-12-04

### Fixed
- Display html for Quill

## [3.1.1] - 2018-12-04

### Added
- Property zoom for maps field

### Fixed
- Show maps coordinates

## [3.1.0] - 2018-12-04

### Added
- Support `argon` hash driver
- Method `canSee` in layout for check display [733](https://github.com/orchidsoftware/platform/issues/733)
- Popovers for fields [734](https://github.com/orchidsoftware/platform/issues/734)
- Field maps leafletjs [714](https://github.com/orchidsoftware/platform/issues/714)
- Quill editor field [724](https://github.com/orchidsoftware/platform/issues/724)

### Changed
- Method `url()` Attachment first parameter is the default value.
- Route use class [729](https://github.com/orchidsoftware/platform/issues/729)
- Route helper `->screen()` no longer requires the third parameter as mandatory, use `->screen(...)->name()`

### Removed
- Google Maps field
- Attachment no longer create copies of images. [719](https://github.com/orchidsoftware/platform/issues/719). Use events for your own creation or packages to create cdn, for example, [Intervention/imagecache](https://github.com/Intervention/imagecache)
- Widget systems now in a separate [package](https://github.com/orchidsoftware/widget)

## [3.0.8] - 2018-11-16

### Fixed
- Input mask array [725](https://github.com/orchidsoftware/platform/issues/725)

## [3.0.7] - 2018-11-15

### Fixed
- Translations

## [3.0.5] - 2018-11-10

### Fixed
- double group name for dropdown menu [718](https://github.com/orchidsoftware/platform/issues/718)

## [3.0.3] - 2018-11-08

### Added
- Example tags from Entities

### Fixed
- always `true` value for builder

## [3.0.2] - 2018-11-07

### Added
- Sort entity from menu [709](https://github.com/orchidsoftware/platform/pull/713)
- Automatically generated language translations for de,es,hi,ru,zh

### Changed
- Hidden support modal from `null` [711](https://github.com/orchidsoftware/platform/pull/711)
- Remove create user from default screen [707](https://github.com/orchidsoftware/platform/pull/707)


## [3.0.1] - 2018-11-06

### Added
- jQuery global  [709](https://github.com/orchidsoftware/platform/pull/709)
- Sub menu [709](https://github.com/orchidsoftware/platform/pull/709)

### Deprecated
- Field::tag use `make` method [710](https://github.com/orchidsoftware/platform/issues/710)

### Fixed
- Migration rollback  [708](https://github.com/orchidsoftware/platform/pull/708)


## [3.0] - 2018-10-29

### Added
- Grouping items using Field::group 
- TD::link and TD::linkPost
- Sorting capability for TD [437](https://github.com/orchidsoftware/platform/issues/437)
- Property display for page
- Added ability to change the logo [354](https://github.com/orchidsoftware/platform/issues/354)
- New command for easy installation `orchid:install` [622](https://github.com/orchidsoftware/platform/issues/622)
- User routes for dashboard
- Custom templates for the sidebar [631](https://github.com/orchidsoftware/platform/issues/631)
- Saved the state of the tabs [666](https://github.com/orchidsoftware/platform/issues/666)
- Added permission for cache

### Deprecated
- TD::name and TD::title use TD::set

### Changed
- Test migration pgsql to sqlite
- User routes for dashboard
- The package was divided into several internal structures (Platform & Press) [634](https://github.com/orchidsoftware/platform/issues/634)
- Rename 'dashboard' to 'platform'
- Order of calling functions in the screen, now the query is executed earlier

### Fixed
- Require to required
- Hide the menu without children
- Deletes a file only if there are no more links [570](https://github.com/orchidsoftware/platform/issues/570)
- Users and roles use screens [579](https://github.com/orchidsoftware/platform/issues/579)
- Deleting a dashboard store [623](https://github.com/orchidsoftware/platform/issues/623)

### Removed
- Bootstrap 3 appendix
- "Delete" button by default in the image field
- String record of parameters for building a form [391](https://github.com/orchidsoftware/platform/issues/391)


## [2.2.4] - 2018-08-28

### Fixed
- Save menu dublicate
- Laravel RouteServiceProvider default namespace override [680](https://github.com/orchidsoftware/platform/issues/680)


## [2.2.4] - 2018-08-28

### Fixed
- Save menu dublicate
- Laravel RouteServiceProvider default namespace override

### Removed
- Font Awesome

## [2.2.3] - 2018-03-01
### Added
- Ukrainian language [595](https://github.com/orchidsoftware/platform/pull/595)

### Changed
- Order of items in the media, first folders then files
- Font Awesome replaced by ORCHID icons

### Fixed
- Flying icon when dragging in the menu
- Sorting menu

## [2.2.2] - 2018-02-18
### Added
- Menu validation [537](https://github.com/orchidsoftware/platform/issues/537)
- Translation of notifications

### Changed
- Jquery load replace turbolink

## [2.2.1] - 2018-02-16

### Added
- Link to attachment [525](https://github.com/orchidsoftware/platform/issues/525)

### Fixed
- Base64 URL Safe  [1](https://github.com/tabuna/tutorial_create_profile_for_orchid/issues/1)
- Double file extension  [526](https://github.com/orchidsoftware/platform/issues/526)

### Changed
- Font Awesome replaced by ORCHID icons
- config "slog" is default

### Removed
- Icon for group

## [2.2.0] - 2018-02-12
### Added
- TinyMCE toolbar #522

### Changed
- Upgrade to Laravel 5.6

### Removed
- Avatar user for database

## [2.1.3] - 2018-02-11

### Fixed
- Default value for select2 AJAX
- Hide password for field

## [2.1.2] - 2018-02-09

### Fixed
- Create of category

## [2.1.1] - 2018-02-09

### Fixed
- Display of the third level menu
- Graphs occupy a full block

## [2.1.0] - 2018-02-09

### Added
- "DIV" Layouts
- "Select" field
- "Show" key for admin menu
- Command `make:chart`
- ORCHID Icons
- Error message validate for forms. #468

### Changed
- Upgrade to Bootstrap 4.0
- Entities and Layouts has a separate folder
- Record fields as objects #391
- Demo "entities" are no longer published
- Access validation does not create multiple database queries
- Hide forms switching with their small number
- Changing the menu, no longer changing the recording number
- Color pallet for graphs
- Design of the file manager

### Deprecated
- Record string/array for fields. Use `Field::make`

### Removed
- google analytics
- robot field
- Simple line icons

## [2.0.14] - 2018-01-16

### Fixed
- Error as select menu "demo post" #457 

## [2.0.11] - 2018-01-09

### Added
- Parameter "format" for "croppie.result" #398
- Displaying old data for validation errors 

### Changed
- Remove source map `npm run production`

### Fixed
- calling relation for new object in template #394
- reset child categories when the parent is deleted

## [2.0.10] - 2017-12-29

### Fixed
- Namespace syntax
- Create empty category

## [2.0.9] - 2017-12-29
### Changed
- Optimization for parser

### Fixed
- Bug name permission for pages

## [2.0.8] - 2017-12-27
### Added 
- Input Mask

### Changed
- Section wrapper remove
- Input build named
- "Not found" message occupies the entire screen
- Error 403 to 404

### Fixed
- Bug permission for entities
- Style for select2
- Calling relation for new object in template #382

## [2.0.7] - 2017-12-19
### Added 
- Thai language
- Fix paginate style
- Width for table

### Changed
- Replacing `less` with` sass`
- Modifying paths `app\Http\Screens` to `app\Http\Controllers\Screens`
- Modifying paths `app\Http\Layouts` to `app\Core\Layouts`

### Fixed
- Sort argument for method Screen
- Remove publish_at from `category`


## [2.0.6] - 2017-12-10
### Added 
- Link method title and modal method
- Fix paginate style

## [2.0.5] - 2017-12-10
### Added 
- Left menu notification
- New button logout
- Added markdown fiends
- Fields picture added stub entities
- Fields SimpleMDE added stub entities

### Deprecated
- Deprecated widget Google analytics

### Removed
- Removed right notification
- Removed right menu
- Removed time picker css

### Fixed
- Video icon to file manager
- Display Area in Chrome 63  

## [2.0.4] - 2017-12-05
### Fixed
- Pagination "..." symbol
- Pagination width
- Load reflection class for Screen

## [2.0.3] - 2017-12-04
### Fixed
- Extra character
- Duplicate error message
- Category prefix
- Update install scout


## [2.0.2] - 2017-12-02
### Added
- Laravel Mix (Manifest&version)
### Fixed
- Update npm dependencies
- Message upload filed


## [2.0.1] - 2017-12-01
### Fixed
- Widget Update


## [2.0] - 2017-12-01
### Added
- Added TinyMCE
- Added support fulltext search
- Added turbolinks
### Changed
- `public` folder is no longer published
- Attachments to each model
- The ability to duplicate a file has been removed
- Removing submodules (Will be in separate packages):
    - Graphical installation
    - Backups
    - Defender
    - Viewing logs
    - Monitor
    - Robot.txt Editor
    - Scheme
    - UTM Tag Generator
    - View all php settings (Form)

### Removed
- Removing Fields
- Removing Footer
- Removing Shortcut
- Removing summernote
- Remote publication of public files, the location of this is used by the proxy controller 

##  [1.1.5] - 2017-09-12
### Added
- Added events for role assignment and deletion


## [1.1.2] - 2017-09-06
### Changed
- Fix bug create user
- Removing unused methods
- Move google analytics to widget

## [1.1.1]
### Added
- Support Laravel 5.5

## [1.1] - 2017-08-31
### Added
- Added global permission for superadmin
### Changed
- fix config display auth
- Summernote supports "media"
- Shortcut (ctrl + s) save form

## [1.0] - 2017-08-04
### Added
- Added menu badges & notifications
- Added the ability to insert js and css code
- Unit tests written

### Removed
- Removing the Content Management System
- Rename config file "content" to "platform"
- Removed auxiliary functions
- Remove unusing fields
- Remove news subscription
