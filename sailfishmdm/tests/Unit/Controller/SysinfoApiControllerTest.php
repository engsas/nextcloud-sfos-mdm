<?php
namespace OCA\SailfishMDM\Tests\Unit\Controller;

require_once __DIR__ . '/SysinfoControllerTest.php';

class SysinfoApiControllerTest extends SysinfoControllerTest {

    public function setUp() {
        parent::setUp();
        $this->controller = new SysinfoApiController(
            'sailfishmdm', $this->request, $this->service, $this->userId
        );
    }

}
