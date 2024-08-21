<?php

namespace OCA\SailfishMDM\Controller;

use OC\User\NoUserException;
use OCA\SailfishMDM\Service\SysinfoService;
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

class SysinfoController extends Controller {

	private $userId;
	private $service;

	public function __construct(string        $appName,
								IRequest      $request,
								SysinfoService $service,
								?string       $userId)
	{
		parent::__construct($appName, $request);
		$this->service = $service;
		$this->userId = $userId;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @return DataResponse
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function index() : DataResponse {
		return new DataResponse($this->service->findAll($this->userId));
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $id
	 * @return DataResponse|Http::STATUS_NOT_FOUND
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function show(int $id) : DataResponse {
		return $this->handleNotFound(function () use ($id) {
			return $this->service->find($id, $this->userId);
		});
	}

	/**
	* @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param string $bluetoothMacAddress
	 * @param string $deviceModel
	 * @param string $deviceUid
	 * @param string $manufacturer
	 * @param string $productName
	 * @param string $softwareVersion
	 * @param string $softwareVersionId
	 * @param string $wlanMacAddress
	 * @return JSONResponse
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function create(
		string $bluetoothMacAddress,
		string $deviceModel,
		string $deviceUid,
		string $manufacturer,
		string $productName,
		string $softwareVersion,
		string $softwareVersionId,
		string $wlanMacAddress
	) {
		return $this->service->create(
			$bluetoothMacAddress,
			$deviceModel,
			$deviceUid,
			$manufacturer,
			$productName,
			$softwareVersion,
			$softwareVersionId,
			$wlanMacAddress
		);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $deviceId
	 * @return DataResponse
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function update(
		int $id,
		string $bluetoothMacAddress,
		string $deviceModel,
		string $deviceUid,
		string $manufacturer,
		string $productName,
		string $softwareVersion,
		string $softwareVersionId,
		string $wlanMacAddress
	) : DataResponse {
		return $this->handleNotFound(function () use (
			$id,
			$bluetoothMacAddress,
			$deviceModel,
			$deviceUid,
			$manufacturer,
			$productName,
			$softwareVersion,
			$softwareVersionId,
			$wlanMacAddress
		) {
			return $this->service->update(
				$id,
				$bluetoothMacAddress,
				$deviceModel,
				$deviceUid,
				$manufacturer,
				$productName,
				$softwareVersion,
				$softwareVersionId,
				$wlanMacAddress
			)
		});
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $deviceId
	 * @return DataResponse
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function destroy(int $deviceId) : DataResponse {
		return $this->handleNotFound(function () use ($id) {
			return $this->service->delete($id, $this->userId);
		});
	}

	/**
	 * @AdminRequired
	 * @NoCSRFRequired
	 *
	 * @return DataResponse
	 * @throws InvalidPathException
	 * @throws NoUserException
	 * @throws NotFoundException
	 * @throws NotPermittedException
	 * @throws LockedException
	 */
	public function adminListAll() : DataResponse {
		return new DataResponse($this->service->findAll(null));
	}
}
