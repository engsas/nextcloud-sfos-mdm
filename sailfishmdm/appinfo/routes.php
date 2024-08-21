<?php

return [
	'resources' => [
			'sysinfo' => ['url' => '/sysinfos']
			'sysinfo_api' => ['url' => '/api/0.1/sysinfos']
	],
	'routes' => [
		['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
	],
];
