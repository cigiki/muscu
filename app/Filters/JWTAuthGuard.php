<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTAuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        $token = null;
        
        if (!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                $token = $matches[1];
            }
        }
        
        if (is_null($token)) {
            return service('response')->setJSON(['error' => 'Token requis'])->setStatusCode(401);
        }

        try {
            $key = getenv('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (Exception $ex) {
            return service('response')->setJSON(['error' => 'Token invalide'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {
        // Ne rien faire
    }
}