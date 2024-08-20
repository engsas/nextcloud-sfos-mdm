<?php

return [
	'routes' => [
		['name' => 'devices#getDevices', 'url' => '/devices', 'verb' => 'GET'],
        ['name' => 'devices#getDevice', 'url' => '/devices/{deviceId}', 'verb' => 'GET'],
	],
];
