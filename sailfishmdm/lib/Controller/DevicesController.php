<?php

namespace OCA\SailfishMDM\Controller;

use OC\User\NoUserException;
use OCA\SailfishMDM\Service\DeviceService;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Services\IInitialState;
use OCP\Files\InvalidPathException;
use OCP\Files\NotFoundException;
use OCP\Files\NotPermittedException;
use OCP\Lock\LockedException;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;

class DevicesController extends Controller {
	/**
	 * @var string|null
	 */
	private $userId;
	/**
	 * @var DevicesService
	 */
	private $devicesService;

	public function __construct(string        $appName,
								IRequest      $request,
								IInitialState $initialStateService,
								DevicesService    $deviceService,
								?string       $userId)
	{
		parent::__construct($appName, $request);
		$this->initialStateService = $initialStateService;
		$this->userId = $userId;
		$this->deviceService = $deviceService;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @return JSONResponse
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function getDevices() : JSONResponse {
		return $this->deviceService->getDevices($this->userId);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $deviceId
	 * @return JSONResponse
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function getDevice(int $deviceId) : JSONResponse {
		return $this->deviceService->getDevice($this->userId, $deviceId);
	}
}
