<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Gaur\Filters\Route\AcceptType;
use Gaur\Filters\Route\Admin;
use Gaur\Filters\Route\ContentType;
use Gaur\Filters\Route\CSRF;
use Gaur\Filters\Route\LoggedIn;
use Gaur\Filters\Route\NotLoggedIn;

class Filters extends BaseConfig
{
	public array $aliases = [
		'accepttype'  => AcceptType::class,
		'admin' 	  => Admin::class,
		'contenttype' => ContentType::class,
		'csrf' 		  => CSRF::class,
		'loggedIn' 	  => LoggedIn::class,
		'notLoggedIn' => NotLoggedIn::class
	];

	public array $globals = [
		'before' => [],
		'after'  => [],
	];

	public array $methods = [];

	public array $filters = [
		'accepttype' => [
			'before' => [
				'api',
				'api/.+'
			]
		],
		'contenttype' => [
			'before' => [
				'api',
				'api/.+'
			]
		],
		'notLoggedIn' => [
			'before' => [
				'account/login',
				'api/account/login',
				'account/register',
				'api/account/register',
				'account/activate/email/([a-fA-F0-9]{256})',
				'api/account/activate/email/([a-fA-F0-9]{256})',
				'account/activate/resend',
				'api/account/activate/resend',
				'account/password/forgot',
				'api/account/password/forgot',
				'account/password/reset/([a-fA-F0-9]{256})',
				'api/account/password/reset/([a-fA-F0-9]{256})'
			]
		],
		'loggedIn' => [
			'before' => [
				'account',
				'account/email',
				'api/account/email',
				'account/password',
				'api/account/password',
				'admin',
				'api/admin',
				'admin/.+',
				'api/admin/.+'
			]
		],
		'admin' => [
			'before' => [
				'admin',
				'api/admin',
				'admin/.+',
				'api/admin/.+'
			]
		],
		'csrf' => [
			'before' => [
				'api/account/login',
				'api/account/register',
				'api/account/activate/resend',
				'api/account/email',
				'api/account/email/update',
				'api/account/password/create',
				'api/account/password/forgot',
				'api/account/password',
				'api/account/password/update',
				'api/admin/users',
				'api/admin/users/([0-9]+)',
			]
		]
	];
}
