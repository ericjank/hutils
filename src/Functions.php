<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Utils\ApplicationContext;

if (! function_exists('catchResult')) {
    function catchResult($ex, $response = null, $request = null) {

        if (!$request || !$response) {
            $container = ApplicationContext::getContainer();

            $request = $request ?? $container->get(\Hyperf\HttpServer\Contract\RequestInterface::class);
            $response = $response ?? $container->get(\Hyperf\HttpServer\Contract\ResponseInterface::class);
        }

        $responseType = $request->input('responseType', 'json');
        $result = [
            'code' => $ex->getCode(),
            'message' => $ex->getMessage()
        ];

        switch ($responseType) {
            case 'raw':
                return $response->raw($result);
            case 'xml':
                return $response->xml($result);
            case 'redirect':
                return $response->redirect('/' . $request->input('redirectTo', ''));
            case 'json':
            default:
                return $response->json($result);
        }
    }
}

