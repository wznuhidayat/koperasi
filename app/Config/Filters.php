<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use \App\Filters\Auth;
use \App\Filters\AuthAdmin;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'auth' => auth::class,
        'authAdmin' => authAdmin::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'auth' => ['except' => ['/auth/*']],
            'authAdmin' => ['except' => ['/auth/*']]
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'auth' => ['except' => ['/main/*']],
            'authAdmin' => ['except' => [
                '/main/index',
                '/main/member*',
                '/main/memberlist*',
                '/main/savingid*',
                '/main/withdrawid*',
                '/main/loanlistid*',
                '/main/installmentid*',
                '/main/saldo*',
                '/main/searchbyid*',
                '/main/addsaving*',
                '/main/withdraw*',
                '/main/printwd*',
                '/main/printsaving*',
                '/main/loan*',
                '/main/printloan*',
                '/main/installmentpay*',
                '/main/invoiceinstallment*',
                '/main/searchinstallment*',
                '/main/printinstallment*',
                '/main/saving*',
                '/main/savinglist*',
                '/main/wd*',
                '/main/withdrawlist*',
                '/main/allloan*',
                '/main/loanlist*',
                '/main/installment*',
                '/main/installmentlist*',
                '/main/printinstallmentid*',
                '/main/profile*',
                ]],
            
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
