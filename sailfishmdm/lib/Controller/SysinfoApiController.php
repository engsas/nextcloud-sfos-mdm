<?php
namespace OCA\SailfishMDM\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\ApiController;

use OCA\SailfishMDM\Service\SysinfoService;

class SysinfoApiController extends ApiController {

    private $service;
    private $userId;

    use Errors;

    public function __construct($AppName, IRequest $request,
                                SysinfoService $service, $userId){
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
			$wlanMacAddress,
            $this->userId
        );
    }

    /**
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param int $id
     * @param string $bluetoothMacAddress
	 * @param string $deviceModel
	 * @param string $deviceUid
	 * @param string $manufacturer
	 * @param string $productName
	 * @param string $softwareVersion
	 * @param string $softwareVersionId
	 * @param string $wlanMacAddress
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
