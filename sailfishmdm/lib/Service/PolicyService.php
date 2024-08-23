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
	 * @param int $id
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
		string $userId,
		string $label,
		bool $defaultPolicy,
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
	) {
		try {
			$policy = new Policy();
			$policy->setUserId($userId);
			$policy->setLabel($label);
			$policy->setDefaultPolicy($defaultPolicy);
			$policy->setAccountCreationEnabled($accountCreationEnabled);
			$policy->setApplicationInstallationEnabled($applicationInstallationEnabled);
			$policy->setBluetoothToggleEnabled($bluetoothToggleEnabled);
			$policy->setBrowserEnabled($browserEnabled);
			$policy->setCallStatisticsSettingsEnabled($callStatisticsSettingsEnabled);
			$policy->setCameraEnabled($cameraEnabled);
			$policy->setCellularTechnologySettingsEnabled($cellularTechnologySettingsEnabled);
			$policy->setDateTimeSettingsEnabled($dateTimeSettingsEnabled);
			$policy->setDeveloperModeSettingsEnabled($developerModeSettingsEnabled);
			$policy->setDeviceResetEnabled($deviceResetEnabled);
			$policy->setFlightModeToggleEnabled($flightModeToggleEnabled);
			$policy->setInternetSharingEnabled($internetSharingEnabled);
			$policy->setLocationSettingsEnabled($locationSettingsEnabled);
			$policy->setMicrophoneEnabled($microphoneEnabled);
			$policy->setMobileDataAccessPointSettingsEnabled($mobileDataAccessPointSettingsEnabled);
			$policy->setMobileNetworkSettingsEnabled($mobileNetworkSettingsEnabled);
			$policy->setNetworkDataCounterSettingsEnabled($networkDataCounterSettingsEnabled);
			$policy->setNetworkProxySettingsEnabled($networkProxySettingsEnabled);
			$policy->setOsUpdatesEnabled($osUpdatesEnabled);
			$policy->setScreenshotEnabled($screenshotEnabled);
			$policy->setSideLoadingSettingsEnabled($sideLoadingSettingsEnabled);
			$policy->setVpnConfigurationSettingsEnabled($vpnConfigurationSettingsEnabled);
			$policy->setVpnConnectionSettingsEnabled($vpnConnectionSettingsEnabled);
			$policy->setWlanToggleEnabled($wlanToggleEnabled);
			return $this->mapper->insert($policy);
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
	public function update(
		int $id,
		string $userId,
		string $label,
		bool $defaultPolicy,
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
	) {

		try {
			$policy = $this->mapper->find($id, $userId);
			$policy->setLabel($label);
			$policy->setDefaultPolicy($defaultPolicy);
			$policy->setAccountCreationEnabled($accountCreationEnabled);
			$policy->setApplicationInstallationEnabled($applicationInstallationEnabled);
			$policy->setBluetoothToggleEnabled($bluetoothToggleEnabled);
			$policy->setBrowserEnabled($browserEnabled);
			$policy->setCallStatisticsSettingsEnabled($callStatisticsSettingsEnabled);
			$policy->setCameraEnabled($cameraEnabled);
			$policy->setCellularTechnologySettingsEnabled($cellularTechnologySettingsEnabled);
			$policy->setDateTimeSettingsEnabled($dateTimeSettingsEnabled);
			$policy->setDeveloperModeSettingsEnabled($developerModeSettingsEnabled);
			$policy->setDeviceResetEnabled($deviceResetEnabled);
			$policy->setFlightModeToggleEnabled($flightModeToggleEnabled);
			$policy->setInternetSharingEnabled($internetSharingEnabled);
			$policy->setLocationSettingsEnabled($locationSettingsEnabled);
			$policy->setMicrophoneEnabled($microphoneEnabled);
			$policy->setMobileDataAccessPointSettingsEnabled($mobileDataAccessPointSettingsEnabled);
			$policy->setMobileNetworkSettingsEnabled($mobileNetworkSettingsEnabled);
			$policy->setNetworkDataCounterSettingsEnabled($networkDataCounterSettingsEnabled);
			$policy->setNetworkProxySettingsEnabled($networkProxySettingsEnabled);
			$policy->setOsUpdatesEnabled($osUpdatesEnabled);
			$policy->setScreenshotEnabled($screenshotEnabled);
			$policy->setSideLoadingSettingsEnabled($sideLoadingSettingsEnabled);
			$policy->setVpnConfigurationSettingsEnabled($vpnConfigurationSettingsEnabled);
			$policy->setVpnConnectionSettingsEnabled($vpnConnectionSettingsEnabled);
			$policy->setWlanToggleEnabled($wlanToggleEnabled);
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
