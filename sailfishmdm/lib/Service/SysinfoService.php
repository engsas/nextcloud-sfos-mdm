<?php

namespace OCA\SailfishMDM\Service;

use Exception;

use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;

use OCA\SailfishMDM\Db\Sysinfo;
use OCA\SailfishMDM\Db\SysinfoMapper;

class SysinfoService {

	private $mapper;

	public function __construct(SysinfoMapper $mapper)	{
		$this->mapper = $mapper;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 */
	public function findAll(string $userId) {
        return $this->mapper->findAll($userId);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $deviceId
	 * @return DataResponse|Http::STATUS_NOT_FOUND
	 */
	public function find(int $id, string $userId) {
		try {
			return $this->mapper->find($id, $userId);
		} catch(Exception $e) {
			$this->handleException($e);
		}
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
	 */
	public function create(
		string $bluetoothMacAddress,
		string $deviceModel,
		string $deviceUid,
		string $manufacturer,
		string $productName,
		string $softwareVersion,
		string $softwareVersionId,
		string $wlanMacAddress,
		string $userId
	) {
		$device = new Sysinfo();
		$device->setUserId($userId);
		$device->setBluetoothMacAddress($bluetoothMacAddress);
		$device->setDeviceModel($deviceModel);
		$device->setDeviceUid($deviceUid);
		$device->setManufacturer($manufacturer);
		$device->setProductName($productName);
		$device->setSoftwareVersion($softwareVersion);
		$device->setSoftwareVersionId($softwareVersionId);
		$device->setWlanMacAddress($wlanMacAddress);
		return $this->mapper->insert($device);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $id
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
		string $wlanMacAddress,
		string $userId
	) {

		try {
			$device = $this->mapper->find($id, $userId);
			$device->setBluetoothMacAddress($bluetoothMacAddress);
			$device->setDeviceModel($deviceModel);
			$device->setDeviceUid($deviceUid);
			$device->setManufacturer($manufacturer);
			$device->setProductName($productName);
			$device->setSoftwareVersion($softwareVersion);
			$device->setSoftwareVersionId($softwareVersionId);
			$device->setWlanMacAddress($wlanMacAddress);
			return $this->mapper->update($device);
		} catch(Exception $e) {
			$this->handleException($e);
		}
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $id
	 */
	public function destroy(int $id, string $userId) {
        try {
            $device = $this->mapper->find($id, $userId);
            $this->mapper->delete($device);
            return $device;
        } catch(Exception $e) {
            $this->handleException($e);
        }
	}

	/**
	 * @AdminRequired
	 * @NoCSRFRequired
	 */
	public function adminListAll() {
		return $this->mapper->findAll(null);
	}

	private function handleException ($e) {
		if ($e instanceof DoesNotExistException ||
			$e instanceof MultipleObjectsReturnedException) {
				throw new NotFoundException($e->getMessage());
		} else {
			throw $e;
		}
	}
}
