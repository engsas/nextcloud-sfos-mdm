<?php
namespace OCA\SailfishMDM\Tests\Unit\Controller;

use PHPUnit\Framework\TestCase;

use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;

use OCA\SailfishMDM\Service\NotFoundException;


class SysinfoControllerTest extends TestCase {

    protected $controller;
    protected $service;
    protected $userId = 'john';
    protected $request;

    public function setUp() {
        $this->request = $this->getMockBuilder('OCP\IRequest')->getMock();
        $this->service = $this->getMockBuilder('OCA\SailfishMDM\Service\SysinfoService')
            ->disableOriginalConstructor()
            ->getMock();
        $this->controller = new SysinfoController(
            'sailfishmdm', $this->request, $this->service, $this->userId
        );
    }

    $bluetoothMacAddress,
			$deviceModel,
			$deviceUid,
			$manufacturer,
			$productName,
			$softwareVersion,
			$softwareVersionId,
			$wlanMacAddress

    public function testUpdate() {
        $softwareVersion = '4.5.0.22';
        $this->service->expects($this->once())
            ->method('update')
            ->with($this->equalTo(3),
                    $this->equalTo('bluetoothMacAddress'),
                    $this->equalTo('deviceModel'),
                    $this->equalTo('deviceUid'),
                    $this->equalTo('manufacturer'),
                    $this->equalTo('productName'),
                    $this->equalTo('softwareVersion'),
                    $this->equalTo('softwareVersionId'),
                    $this->equalTo('wlanMacAddress'),
                    $this->equalTo($this->userId))
            ->will($this->returnValue($softwareVersion));

        $result = $this->controller->update(
            3,
            'bluetoothMacAddress',
            'deviceModel',
            'deviceUid',
            'manufacturer',
            'productName',
            'softwareVersion',
            'softwareVersionId',
            'wlanMacAddress'
        );

        $this->assertEquals($softwareVersion, $result->getData());
    }


    public function testUpdateNotFound() {
        // test the correct status code if no note is found
        $this->service->expects($this->once())
            ->method('update')
            ->will($this->throwException(new NotFoundException()));

        $result = $this->controller->update(
            3,
            'bluetoothMacAddress',
            'deviceModel',
            'deviceUid',
            'manufacturer',
            'productName',
            'softwareVersion',
            'softwareVersionId',
            'wlanMacAddress'
        );

        $this->assertEquals(Http::STATUS_NOT_FOUND, $result->getStatus());
    }

}
