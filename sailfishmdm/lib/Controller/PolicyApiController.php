<?php
namespace OCA\SailfishMDM\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\ApiController;

use OCA\SailfishMDM\Service\PolicyService;

class PolicyApiController extends ApiController {

    private $service;
    private $userId;

    use Errors;

    public function __construct($AppName, IRequest $request,
                                PolicyService $service, $userId){
        parent::__construct($AppName, $request);
        $this->service = $service;
        $this->userId = $userId;
    }

    /**
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     */
    public function index() {
        return new DataResponse($this->service->findAll($this->userId));
    }

    /**
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param int $id
     */
    public function show($id) {
        return $this->handleNotFound(function () use ($id) {
            return $this->service->find($id, $this->userId);
        });
    }

    /**
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
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
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
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
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param int $id
     */
    public function destroy($id) {
        return $this->handleNotFound(function () use ($id) {
            return $this->service->destroy($id, $this->userId);
        });
    }

}