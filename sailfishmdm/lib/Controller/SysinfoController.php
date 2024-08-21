<?php

namespace OCA\SailfishMDM\Controller;

use OCA\SailfishMDM\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;

use OCA\SailfishMDM\Service\SysinfoService;

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
	 */
	public function index() : DataResponse {
		return new DataResponse($this->service->findAll($this->userId));
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 */
	public function show(int $id) : DataResponse {
		return $this->handleNotFound(function () use ($id) {
			return $this->service->find($id, $this->userId);
		});
	}

	/**
	* @NoAdminRequired
	 * @NoCSRFRequired
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
	 */
	public function update(
        $id,
        string $bluetoothMacAddress,
        string $deviceModel,
        string $deviceUid,
        string $manufacturer,
        string $productName,
        string $softwareVersion,
        string $softwareVersionId,
        string $wlanMacAddress
    ) {
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
                $wlanMacAddress,
                $this->userId
            );
        });
    }

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function destroy(int $id) : DataResponse {
		return $this->handleNotFound(function () use ($id) {
			return $this->service->destroy($id, $this->userId);
		});
	}

	/**
	 * @AdminRequired
	 * @NoCSRFRequired
	 */
	public function adminListAll() : DataResponse {
		return new DataResponse($this->service->findAll(null));
	}
}
