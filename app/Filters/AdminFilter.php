<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the user is not logged in
        if (!session()->get('logged_in')) {
            session()->setFlashdata('pesan', 'Anda Belum Login');
            return redirect()->to('/');
        }

        // Check if the user's role is not 'Admin'
        if (session()->get('role') != 'Admin') {
            session()->setFlashdata('pesan', 'Anda tidak memiliki akses');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here after the request
    }
}