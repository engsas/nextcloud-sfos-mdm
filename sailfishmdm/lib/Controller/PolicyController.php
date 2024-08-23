<?php

namespace OCA\SailfishMDM\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

use OCA\SailfishMDM\Service\PolicyService;

class PolicyController extends Controller {

	private $service;
	private $userId;

	use Errors;

	public function __construct(string        $appName,
								IRequest      $request,
								PolicyService $service,
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
		bool $wlanToggleEnabled
	) {
		return $this->service->create(
			$label,
			$accountCreationEnabled,
			$applicationInstallationEnabled,
			$bluetoothToggleEnabled,
			$browserEnabled,
			$callStatisticsSettingsEnabled,
			$cameraEnabled,
			$cellularTechnologySettingsEnabled,
			$dateTimeSettingsEnabled,
			$developerModeSettingsEnabled,
			$deviceResetEnabled,
			$flightModeToggleEnabled,
			$internetSharingEnabled,
			$locationSettingsEnabled,
			$microphoneEnabled,
			$mobileDataAccessPointSettingsEnabled,
			$mobileNetworkSettingsEnabled,
			$networkDataCounterSettingsEnabled,
			$networkProxySettingsEnabled,
			$osUpdatesEnabled,
			$screenshotEnabled,
			$sideLoadingSettingsEnabled,
			$vpnConfigurationSettingsEnabled,
			$vpnConnectionSettingsEnabled,
			$wlanToggleEnabled,
            $this->userId
		);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function update(
        $id,
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
		bool $wlanToggleEnabled
    ) {
        return $this->handleNotFound(function () use (
			$id,
			$label,
			$accountCreationEnabled,
			$applicationInstallationEnabled,
			$bluetoothToggleEnabled,
			$browserEnabled,
			$callStatisticsSettingsEnabled,
			$cameraEnabled,
			$cellularTechnologySettingsEnabled,
			$dateTimeSettingsEnabled,
			$developerModeSettingsEnabled,
			$deviceResetEnabled,
			$flightModeToggleEnabled,
			$internetSharingEnabled,
			$locationSettingsEnabled,
			$microphoneEnabled,
			$mobileDataAccessPointSettingsEnabled,
			$mobileNetworkSettingsEnabled,
			$networkDataCounterSettingsEnabled,
			$networkProxySettingsEnabled,
			$osUpdatesEnabled,
			$screenshotEnabled,
			$sideLoadingSettingsEnabled,
			$vpnConfigurationSettingsEnabled,
			$vpnConnectionSettingsEnabled,
			$wlanToggleEnabled
		) {
            return $this->service->update(
                $id,
				$label,
				$accountCreationEnabled,
				$applicationInstallationEnabled,
				$bluetoothToggleEnabled,
				$browserEnabled,
				$callStatisticsSettingsEnabled,
				$cameraEnabled,
				$cellularTechnologySettingsEnabled,
				$dateTimeSettingsEnabled,
				$developerModeSettingsEnabled,
				$deviceResetEnabled,
				$flightModeToggleEnabled,
				$internetSharingEnabled,
				$locationSettingsEnabled,
				$microphoneEnabled,
				$mobileDataAccessPointSettingsEnabled,
				$mobileNetworkSettingsEnabled,
				$networkDataCounterSettingsEnabled,
				$networkProxySettingsEnabled,
				$osUpdatesEnabled,
				$screenshotEnabled,
				$sideLoadingSettingsEnabled,
				$vpnConfigurationSettingsEnabled,
				$vpnConnectionSettingsEnabled,
				$wlanToggleEnabled,
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
