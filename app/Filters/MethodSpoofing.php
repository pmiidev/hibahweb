<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MethodSpoofing implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default, it should not change the request and response
     * objects.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $method = strtolower($request->getMethod());

        // Hanya proses jika method adalah POST
        if ($method === 'post') {
            // Cek apakah ada _method field dalam POST data
            $spoofedMethod = $request->getPost('_method');

            if ($spoofedMethod !== null) {
                $spoofedMethod = strtoupper($spoofedMethod);

                // Validasi bahwa method yang di-spoof adalah PUT atau DELETE
                if (in_array($spoofedMethod, ['PUT', 'DELETE', 'PATCH'], true)) {
                    // Ubah method request menjadi yang di-spoof
                    $request = $request->withMethod($spoofedMethod);
                }
            }
        }

        return $request;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not need to do anything,
     * so it only has the minimal signature for a filter.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
