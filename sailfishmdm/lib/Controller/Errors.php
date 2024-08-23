<?php

namespace OCA\SailfishMDM\Controller;

use Closure;

use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;

use OCA\SailfishMDM\Service\SysinfoNotFound;
use OCA\SailfishMDM\Service\PolicyNotFound;


trait Errors {

    protected function handleNotFound (Closure $callback) {
        try {
            return new DataResponse($callback());
        } catch(SysinfoNotFound $e) {
            $message = ['message' => $e->getMessage()];
            return new DataResponse($message, Http::STATUS_NOT_FOUND);
        } catch(PolicyNotFound $e) {
            $message = ['message' => $e->getMessage()];
            return new DataResponse($message, Http::STATUS_NOT_FOUND);
        }
    }

}
