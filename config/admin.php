<?php

return [

    /*
     * Admin name.
     */
    'name' => 'Admin Panel',

    /*
     * Logo in admin panel header.
     */
    'logo' => '<b>Admin</b> panel',

    /*
     * Mini-logo in admin panel header.
     */
    'logo-mini' => '<b>Ap</b>',

    /*
     * Route configuration.
     */
    'route' => [

        'prefix' => 'admin',

        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'admin'],
    ],

    /*
     * Admin install directory.
     */
    'directory' => app_path('Admin'),

    /*
     * Admin html title.
     */
    'title' => 'Admin',

    /*
     * Use `https`.
     */
    'secure' => false,

    /*
     * Laravel admin auth setting.
     */
    'auth' => [
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Core\Admin\Auth\Database\Administrator::class,
            ],
        ],
    ],

    /*
     * Admin upload setting.
     */
    'upload' => [

        'disk' => 'admin',

        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    /*
     * Admin database setting.
     */
    'database' => [

        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => Core\Admin\Auth\Database\Administrator::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Core\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Core\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table' => 'admin_menu',
        'menu_model' => Core\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
     * By setting this option to open or close operation log in admin.
     */
    'operation_log' => [

        'enable' => true,

        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs
         */
        'except' => [
            'admin/auth/logs*',
        ],
    ],


    'skin' => 'skin-gray',
    
    'layout' => ['sidebar-mini'],

    /*
     * Version displayed in footer.
     */
    'version' => '1.0',

    /*
     * Settings for extensions.
     */
    'extensions' => [
	/*'media-manager' => [
            'disk' => 'uploads'
        ],*/
    ],
];
