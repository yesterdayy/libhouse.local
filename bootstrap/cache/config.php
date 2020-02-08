<?php return array (
  'active' => 
  array (
    'class' => 'active',
  ),
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://libhouse.local/',
    'timezone' => 'Europe/Moscow',
    'locale' => 'ru',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:Jf+gvEi37zQUr7XnVVGAFZIVT3pZqPJrAqfnYpqPCrs=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Collective\\Html\\HtmlServiceProvider',
      23 => 'Biscolab\\ReCaptcha\\ReCaptchaServiceProvider',
      24 => 'Torann\\GeoIP\\GeoIPServiceProvider',
      25 => 'App\\Providers\\AppServiceProvider',
      26 => 'App\\Providers\\AuthServiceProvider',
      27 => 'App\\Providers\\EventServiceProvider',
      28 => 'App\\Providers\\RouteServiceProvider',
      29 => 'App\\Providers\\BlogServiceProvider',
      30 => 'Intervention\\Image\\ImageServiceProvider',
      31 => 'Barryvdh\\Debugbar\\ServiceProvider',
      32 => 'Propaganistas\\LaravelPhone\\PhoneServiceProvider',
      33 => 'App\\Providers\\ShortcodesServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'ReCaptcha' => 'Biscolab\\ReCaptcha\\Facades\\ReCaptcha',
      'GeoIP' => 'Torann\\GeoIP\\Facades\\GeoIP',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'breadcrumbs' => 
  array (
    'view' => 'breadcrumbs::bootstrap4',
    'files' => 'C:\\OSPanel\\domains\\libhouse.local\\routes/breadcrumbs.php',
    'unnamed-route-exception' => true,
    'missing-route-bound-breadcrumb-exception' => true,
    'invalid-named-breadcrumb-exception' => true,
    'manager-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsManager',
    'generator-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsGenerator',
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'adv',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'adv',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
      ),
      'kladr' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'kladr',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'adv',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'adv',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => true,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'timeline' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\app/public',
        'url' => 'http://libhouse.local//storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
    ),
    'thumbnails_size' => 
    array (
      'thumb' => 
      array (
        'name' => 'Миниатюра',
        'slug' => 'thumb',
        'value' => 
        array (
          0 => 435,
          1 => 348,
        ),
      ),
      'thumb-wide' => 
      array (
        'name' => 'Миниатюра для объявлений в профиле',
        'slug' => 'thumb-wide',
        'value' => 
        array (
          0 => 318,
          1 => 198,
        ),
      ),
      'slide-wide' => 
      array (
        'name' => 'Картинка для слайда',
        'slug' => 'slide-wide',
        'value' => 
        array (
          0 => 1345,
          1 => 700,
        ),
      ),
      'slide-thumb' => 
      array (
        'name' => 'Миниатюра картинок для навигации по слайдам',
        'slug' => 'slide-thumb',
        'value' => 
        array (
          0 => 150,
          1 => 150,
        ),
      ),
    ),
  ),
  'geoip' => 
  array (
    'log_failures' => true,
    'include_currency' => true,
    'service' => 'maxmind_database',
    'services' => 
    array (
      'maxmind_database' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindDatabase',
        'database_path' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\app/geoip.mmdb',
        'update_url' => 'https://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz',
        'locales' => 
        array (
          0 => 'ru',
        ),
      ),
      'maxmind_api' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\MaxMindWebService',
        'user_id' => NULL,
        'license_key' => NULL,
        'locales' => 
        array (
          0 => 'en',
        ),
      ),
      'ipapi' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\IPApi',
        'secure' => true,
        'key' => NULL,
        'continent_path' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\app/continents.json',
        'lang' => 'ru',
      ),
      'ipgeolocation' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\IPGeoLocation',
        'secure' => true,
        'key' => NULL,
        'continent_path' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\app/continents.json',
        'lang' => 'en',
      ),
      'ipdata' => 
      array (
        'class' => 'Torann\\GeoIP\\Services\\IPData',
        'key' => NULL,
        'secure' => true,
      ),
    ),
    'cache' => 'none',
    'cache_tags' => NULL,
    'cache_expires' => 30,
    'default_location' => 
    array (
      'ip' => '127.0.0.0',
      'iso_code' => 'US',
      'country' => 'United States',
      'city' => 'New Haven',
      'state' => 'CT',
      'state_name' => 'Connecticut',
      'postal_code' => '06510',
      'lat' => 41.31,
      'lon' => -72.92,
      'timezone' => 'America/New_York',
      'continent' => 'NA',
      'default' => true,
      'currency' => 'USD',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => '587',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => 'tls',
    'username' => 'yesterdayy33@gmail.com',
    'password' => '305lz.1xs',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\OSPanel\\domains\\libhouse.local\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'platform' => 
  array (
    'domain' => NULL,
    'prefix' => '/dashboard',
    'middleware' => 
    array (
      'public' => 
      array (
        0 => 'web',
      ),
      'private' => 
      array (
        0 => 'web',
        1 => 'platform',
      ),
    ),
    'auth' => true,
    'index' => 'platform.main',
    'resource' => 
    array (
      'stylesheets' => 
      array (
      ),
      'scripts' => 
      array (
      ),
    ),
    'template' => 
    array (
      'header' => 'platform::layouts.header',
      'footer' => 'platform::layouts.footer',
    ),
  ),
  'press' => 
  array (
    'locales' => 
    array (
      'en' => 
      array (
        'name' => 'English',
        'script' => 'Latn',
        'dir' => 'ltr',
        'native' => 'English',
        'regional' => 'en_GB',
      ),
    ),
    'menu' => 
    array (
      'header' => 'Header menu',
      'sidebar' => 'Sidebar menu',
      'footer' => 'Footer menu',
    ),
  ),
  'queue' => 
  array (
    'default' => 'redis',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'recaptcha' => 
  array (
    'api_site_key' => '',
    'api_secret_key' => '',
    'version' => 'v2',
    'skip_ip' => 
    array (
    ),
  ),
  'scout' => 
  array (
    'driver' => NULL,
    'prefix' => '',
    'queue' => false,
    'chunk' => 
    array (
      'searchable' => 500,
      'unsearchable' => 500,
    ),
    'soft_delete' => false,
    'algolia' => 
    array (
      'id' => '',
      'secret' => '',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => 'sandbox267ae33d02d045638f11ba6d7054bc6f.mailgun.org',
      'secret' => '77c3a4e52c422b59a2ce9cd77c821ca7-e566273b-fb226bbd',
      'endpoint' => 'api.mailgun.net',
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\Models\\User\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'sleeping_owl' => 
  array (
    'title' => 'Sleeping Owl administrator',
    'logo' => '<svg style="padding:10px;" class="pull-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 216.123 216.123" style="enable-background:new 0 0 216.123 216.123;" xml:space="preserve" width="48px" height="48px"><g><path d="M173.65,106.51c6.549-7.024,10.567-16.436,10.567-26.774c0-8.585-2.775-16.529-7.464-23.001   c5.319-16.633,5.063-34.71-0.795-51.16L173.974,0l-5.827,1.03c-12.002,2.121-23.325,6.931-33.201,14.037H81.537v0.252   C71.577,8.071,60.122,3.176,47.977,1.03L42.149,0l-1.985,5.575c-5.858,16.45-6.114,34.527-0.795,51.16   c-4.689,6.472-7.464,14.417-7.464,23.001c0,10.338,4.018,19.75,10.567,26.773c-1.028,0.797-1.846,1.88-2.308,3.179   c-10.874,30.534-2.352,64.292,21.71,86c1.048,0.945,2.171,1.862,3.332,2.761v10.673c0,3.866,3.134,7,7,7s7-3.134,7-7v-2.194   c8.347,3.957,17.834,6.887,27.532,8.373c0.352,0.054,0.706,0.081,1.06,0.081s0.708-0.027,1.06-0.081   c4.446-0.681,16.123-2.878,28.059-8.434v2.255c0,3.866,3.134,7,7,7s7-3.134,7-7v-10.656c1.139-0.883,2.254-1.805,3.332-2.777   c24.062-21.709,32.583-55.466,21.71-86C175.496,108.389,174.678,107.306,173.65,106.51z M107.969,152.066   c-4.506-10.226-11.165-19.465-19.743-27.206c-2.717-2.451-5.583-4.7-8.571-6.748c13.12-2.887,23.804-12.341,28.406-24.734   c4.602,12.393,15.286,21.847,28.406,24.734c-2.988,2.048-5.854,4.297-8.57,6.748C119.346,132.575,112.595,141.88,107.969,152.066z    M71.206,54.436c13.951,0,25.301,11.35,25.301,25.301s-11.35,25.301-25.301,25.301s-25.301-11.35-25.301-25.301   S57.255,54.436,71.206,54.436z M170.218,79.736c0,13.951-11.35,25.301-25.301,25.301s-25.301-11.35-25.301-25.301   s11.35-25.301,25.301-25.301S170.218,65.786,170.218,79.736z M108.041,48.088c-3.04-6.825-7.023-13.231-11.845-19.021h23.699   C115.052,34.867,111.074,41.273,108.041,48.088z M164.562,16.17c2.468,9.767,2.65,20.018,0.566,29.875   c-5.909-3.558-12.824-5.61-20.21-5.61c-7.254,0-14.05,1.983-19.889,5.425c3.327-5.397,7.423-10.367,12.248-14.72   C145.142,24.043,154.479,18.934,164.562,16.17z M51.562,16.17c10.082,2.763,19.419,7.872,27.286,14.97   c4.792,4.324,8.877,9.293,12.205,14.695c-5.83-3.426-12.61-5.401-19.847-5.401c-7.386,0-14.301,2.051-20.21,5.61   C48.912,36.188,49.094,25.937,51.562,16.17z M51.555,120.283c10.084,2.763,19.425,7.873,27.293,14.972   c13.908,12.549,21.704,29.884,21.95,48.812v15.742c-10.093-2.564-21.543-7.294-29.546-14.514   C52.951,168.783,45.553,143.818,51.555,120.283z M144.871,185.295c-7.99,7.21-19.708,11.96-30.073,14.539v-15.766   c0.239-18.349,8.431-36.14,22.478-48.813c7.868-7.1,17.209-12.209,27.293-14.972C170.57,143.818,163.172,168.783,144.871,185.295z" fill="#FFFFFF"/><circle cx="71.206" cy="79.736" r="9.757" fill="#FFFFFF"/><circle cx="144.917" cy="79.736" r="9.757" fill="#FFFFFF"/></g></svg> <span class="pull-left">SleepingOwl</span>',
    'logo_mini' => '<svg style="padding:7px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 216.123 216.123" style="enable-background:new 0 0 216.123 216.123;" xml:space="preserve" width="48px" height="48px"><g><path d="M173.65,106.51c6.549-7.024,10.567-16.436,10.567-26.774c0-8.585-2.775-16.529-7.464-23.001   c5.319-16.633,5.063-34.71-0.795-51.16L173.974,0l-5.827,1.03c-12.002,2.121-23.325,6.931-33.201,14.037H81.537v0.252   C71.577,8.071,60.122,3.176,47.977,1.03L42.149,0l-1.985,5.575c-5.858,16.45-6.114,34.527-0.795,51.16   c-4.689,6.472-7.464,14.417-7.464,23.001c0,10.338,4.018,19.75,10.567,26.773c-1.028,0.797-1.846,1.88-2.308,3.179   c-10.874,30.534-2.352,64.292,21.71,86c1.048,0.945,2.171,1.862,3.332,2.761v10.673c0,3.866,3.134,7,7,7s7-3.134,7-7v-2.194   c8.347,3.957,17.834,6.887,27.532,8.373c0.352,0.054,0.706,0.081,1.06,0.081s0.708-0.027,1.06-0.081   c4.446-0.681,16.123-2.878,28.059-8.434v2.255c0,3.866,3.134,7,7,7s7-3.134,7-7v-10.656c1.139-0.883,2.254-1.805,3.332-2.777   c24.062-21.709,32.583-55.466,21.71-86C175.496,108.389,174.678,107.306,173.65,106.51z M107.969,152.066   c-4.506-10.226-11.165-19.465-19.743-27.206c-2.717-2.451-5.583-4.7-8.571-6.748c13.12-2.887,23.804-12.341,28.406-24.734   c4.602,12.393,15.286,21.847,28.406,24.734c-2.988,2.048-5.854,4.297-8.57,6.748C119.346,132.575,112.595,141.88,107.969,152.066z    M71.206,54.436c13.951,0,25.301,11.35,25.301,25.301s-11.35,25.301-25.301,25.301s-25.301-11.35-25.301-25.301   S57.255,54.436,71.206,54.436z M170.218,79.736c0,13.951-11.35,25.301-25.301,25.301s-25.301-11.35-25.301-25.301   s11.35-25.301,25.301-25.301S170.218,65.786,170.218,79.736z M108.041,48.088c-3.04-6.825-7.023-13.231-11.845-19.021h23.699   C115.052,34.867,111.074,41.273,108.041,48.088z M164.562,16.17c2.468,9.767,2.65,20.018,0.566,29.875   c-5.909-3.558-12.824-5.61-20.21-5.61c-7.254,0-14.05,1.983-19.889,5.425c3.327-5.397,7.423-10.367,12.248-14.72   C145.142,24.043,154.479,18.934,164.562,16.17z M51.562,16.17c10.082,2.763,19.419,7.872,27.286,14.97   c4.792,4.324,8.877,9.293,12.205,14.695c-5.83-3.426-12.61-5.401-19.847-5.401c-7.386,0-14.301,2.051-20.21,5.61   C48.912,36.188,49.094,25.937,51.562,16.17z M51.555,120.283c10.084,2.763,19.425,7.873,27.293,14.972   c13.908,12.549,21.704,29.884,21.95,48.812v15.742c-10.093-2.564-21.543-7.294-29.546-14.514   C52.951,168.783,45.553,143.818,51.555,120.283z M144.871,185.295c-7.99,7.21-19.708,11.96-30.073,14.539v-15.766   c0.239-18.349,8.431-36.14,22.478-48.813c7.868-7.1,17.209-12.209,27.293-14.972C170.57,143.818,163.172,168.783,144.871,185.295z" fill="#FFFFFF"/><circle cx="71.206" cy="79.736" r="9.757" fill="#FFFFFF"/><circle cx="144.917" cy="79.736" r="9.757" fill="#FFFFFF"/></g></svg>',
    'url_prefix' => 'admin',
    'domain' => false,
    'middleware' => 
    array (
      0 => 'web',
      1 => 'auth',
    ),
    'env_editor_url' => 'env/editor',
    'env_editor_excluded_keys' => 
    array (
      0 => 'APP_KEY',
      1 => 'DB_*',
    ),
    'env_editor_middlewares' => 
    array (
    ),
    'show_editor' => false,
    'auth_provider' => 'users',
    'bootstrapDirectory' => 'C:\\OSPanel\\domains\\libhouse.local\\app\\Admin',
    'imagesUploadDirectory' => 'images/uploads',
    'filesUploadDirectory' => 'files/uploads',
    'template' => 'SleepingOwl\\Admin\\Templates\\TemplateDefault',
    'datetimeFormat' => 'd-m-Y H:i',
    'dateFormat' => 'd-m-Y',
    'timeFormat' => 'H:i',
    'timezone' => 'UTC',
    'wysiwyg' => 
    array (
      'default' => 'ckeditor',
      'ckeditor' => 
      array (
        'defaultLanguage' => 'ru',
        'height' => 200,
        'allowedContent' => true,
        'extraPlugins' => 'uploadimage,image2,justify,youtube,uploadfile',
      ),
      'tinymce' => 
      array (
        'height' => 200,
      ),
    ),
    'datatables' => 
    array (
    ),
    'breadcrumbs' => false,
    'aliases' => 
    array (
      'Assets' => 'KodiCMS\\Assets\\Facades\\Assets',
      'PackageManager' => 'KodiCMS\\Assets\\Facades\\PackageManager',
      'Meta' => 'KodiCMS\\Assets\\Facades\\Meta',
      'Form' => 'Collective\\Html\\FormFacade',
      'HTML' => 'Collective\\Html\\HtmlFacade',
      'WysiwygManager' => 'SleepingOwl\\Admin\\Facades\\WysiwygManager',
      'MessagesStack' => 'SleepingOwl\\Admin\\Facades\\MessageStack',
      'AdminSection' => 'SleepingOwl\\Admin\\Facades\\Admin',
      'AdminTemplate' => 'SleepingOwl\\Admin\\Facades\\Template',
      'AdminNavigation' => 'SleepingOwl\\Admin\\Facades\\Navigation',
      'AdminColumn' => 'SleepingOwl\\Admin\\Facades\\TableColumn',
      'AdminColumnEditable' => 'SleepingOwl\\Admin\\Facades\\TableColumnEditable',
      'AdminColumnFilter' => 'SleepingOwl\\Admin\\Facades\\TableColumnFilter',
      'AdminDisplayFilter' => 'SleepingOwl\\Admin\\Facades\\DisplayFilter',
      'AdminForm' => 'SleepingOwl\\Admin\\Facades\\Form',
      'AdminFormElement' => 'SleepingOwl\\Admin\\Facades\\FormElement',
      'AdminDisplay' => 'SleepingOwl\\Admin\\Facades\\Display',
      'AdminWidgets' => 'SleepingOwl\\Admin\\Facades\\Widgets',
    ),
  ),
  'sluggable' => 
  array (
    'source' => NULL,
    'maxLength' => NULL,
    'maxLengthKeepWords' => true,
    'method' => NULL,
    'separator' => '-',
    'unique' => true,
    'uniqueSuffix' => NULL,
    'includeTrashed' => false,
    'reserved' => NULL,
    'onUpdate' => false,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\OSPanel\\domains\\libhouse.local\\resources\\views',
    ),
    'compiled' => 'C:\\OSPanel\\domains\\libhouse.local\\storage\\framework\\views',
  ),
  'widget' => 
  array (
    'widgets' => 
    array (
    ),
  ),
);
