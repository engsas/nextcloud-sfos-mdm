<?php

return [
	'resources' => [
			'sysinfo' => ['url' => '/sysinfos'],
			'sysinfo_api' => ['url' => '/api/0.1/sysinfos'],
			'policy' => ['url' => '/policies'],
			'policy_api' => ['url' => '/api/0.1/policies']
	],
	'routes' => [
		['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
		['name' => 'sysinfo_api#preflighted_cors', 'url' => '/api/0.1/{path}',
			'verb' => 'OPTIONS', 'requirements' => ['path' => '.+']],
		['name' => 'policy_api#preflighted_cors', 'url' => '/api/0.1/{path}',
			'verb' => 'OPTIONS', 'requirements' => ['path' => '.+']]
	],
];
