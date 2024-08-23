<?php

namespace OCA\SailfishMDM\Service;

use Exception;

use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;

use OCA\SailfishMDM\Db\Policy;
use OCA\SailfishMDM\Db\PolicyMapper;

class PolicyService {

	private $mapper;

	public function __construct(PolicyMapper $mapper)	{
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
	 */
	public function create(
		bool $label,
		bool $accountCreationEnabled,
		bool $applicationInstallationEnabled,
		bool $bluetoothToggleEnabled,
		bool $browserEnabled,
		bool $callStatisticsSettingsEnabled,
		bool $cameraEnabled,
		bool $cellularTechnologySettingsEnabled,
		bool $dateTimeSettingsEnabled,
		bool $developerModeSettingsEnabled,
		bool $deviceResetEnabled,
		bool $flightModeToggleEnabled,
		bool $internetSharingEnabled,
		bool $locationSettingsEnabled,
		bool $microphoneEnabled,
		bool $mobileDataAccessPointSettingsEnabled,
		bool $mobileNetworkSettingsEnabled,
		bool $networkDataCounterSettingsEnabled,
		bool $networkProxySettingsEnabled,
		bool $osUpdatesEnabled,
		bool $screenshotEnabled,
		bool $sideLoadingSettingsEnabled,
		bool $vpnConfigurationSettingsEnabled,
		bool $vpnConnectionSettingsEnabled,
		bool $wlanToggleEnabled,
		string $userId
	) {
		$policy = new Policy();
		$policy->setUserId($userId);
		$policy->setLabel($label);
		$policy->setBluetoothMacAddress($accountCreationEnabled);
		$policy->setDeviceModel($applicationInstallationEnabled);
		$policy->setDeviceUid($bluetoothToggleEnabled);
		$policy->setManufacturer($browserEnabled);
		$policy->setProductName($callStatisticsSettingsEnabled);
		$policy->setSoftwareVersion($cameraEnabled);
		$policy->setSoftwareVersionId($cellularTechnologySettingsEnabled);
		$policy->setWlanMacAddress($dateTimeSettingsEnabled);
		$policy->setBluetoothMacAddress($developerModeSettingsEnabled);
		$policy->setDeviceModel($deviceResetEnabled);
		$policy->setDeviceUid($flightModeToggleEnabled);
		$policy->setManufacturer($internetSharingEnabled);
		$policy->setProductName($locationSettingsEnabled);
		$policy->setSoftwareVersion($microphoneEnabled);
		$policy->setSoftwareVersionId($mobileDataAccessPointSettingsEnabled);
		$policy->setWlanMacAddress($mobileNetworkSettingsEnabled);
		$policy->setBluetoothMacAddress($networkDataCounterSettingsEnabled);
		$policy->setDeviceModel($networkProxySettingsEnabled);
		$policy->setDeviceUid($osUpdatesEnabled);
		$policy->setManufacturer($screenshotEnabled);
		$policy->setProductName($sideLoadingSettingsEnabled);
		$policy->setSoftwareVersion($vpnConfigurationSettingsEnabled);
		$policy->setSoftwareVersionId($vpnConnectionSettingsEnabled);
		$policy->setWlanMacAddress($wlanToggleEnabled);
		return $this->mapper->insert($policy);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param int $id
	 */
	public function update(
		int $id,
		bool $label,
		bool $accountCreationEnabled,
		bool $applicationInstallationEnabled,
		bool $bluetoothToggleEnabled,
		bool $browserEnabled,
		bool $callStatisticsSettingsEnabled,
		bool $cameraEnabled,
		bool $cellularTechnologySettingsEnabled,
		bool $dateTimeSettingsEnabled,
		bool $developerModeSettingsEnabled,
		bool $deviceResetEnabled,
		bool $flightModeToggleEnabled,
		bool $internetSharingEnabled,
		bool $locationSettingsEnabled,
		bool $microphoneEnabled,
		bool $mobileDataAccessPointSettingsEnabled,
		bool $mobileNetworkSettingsEnabled,
		bool $networkDataCounterSettingsEnabled,
		bool $networkProxySettingsEnabled,
		bool $osUpdatesEnabled,
		bool $screenshotEnabled,
		bool $sideLoadingSettingsEnabled,
		bool $vpnConfigurationSettingsEnabled,
		bool $vpnConnectionSettingsEnabled,
		bool $wlanToggleEnabled,
		string $userId
	) {

		try {
			$policy = $this->mapper->find($id, $label);
			$policy->setLabel($label);
			$policy->setBluetoothMacAddress($accountCreationEnabled);
			$policy->setDeviceModel($applicationInstallationEnabled);
			$policy->setDeviceUid($bluetoothToggleEnabled);
			$policy->setManufacturer($browserEnabled);
			$policy->setProductName($callStatisticsSettingsEnabled);
			$policy->setSoftwareVersion($cameraEnabled);
			$policy->setSoftwareVersionId($cellularTechnologySettingsEnabled);
			$policy->setWlanMacAddress($dateTimeSettingsEnabled);
			$policy->setBluetoothMacAddress($developerModeSettingsEnabled);
			$policy->setDeviceModel($deviceResetEnabled);
			$policy->setDeviceUid($flightModeToggleEnabled);
			$policy->setManufacturer($internetSharingEnabled);
			$policy->setProductName($locationSettingsEnabled);
			$policy->setSoftwareVersion($microphoneEnabled);
			$policy->setSoftwareVersionId($mobileDataAccessPointSettingsEnabled);
			$policy->setWlanMacAddress($mobileNetworkSettingsEnabled);
			$policy->setBluetoothMacAddress($networkDataCounterSettingsEnabled);
			$policy->setDeviceModel($networkProxySettingsEnabled);
			$policy->setDeviceUid($osUpdatesEnabled);
			$policy->setManufacturer($screenshotEnabled);
			$policy->setProductName($sideLoadingSettingsEnabled);
			$policy->setSoftwareVersion($vpnConfigurationSettingsEnabled);
			$policy->setSoftwareVersionId($vpnConnectionSettingsEnabled);
			$policy->setWlanMacAddress($wlanToggleEnabled);
			return $this->mapper->update($policy);
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
