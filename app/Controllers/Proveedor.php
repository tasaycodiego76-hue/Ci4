<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProveedorModel;
use CodeIgniter\HTTP\RedirectResponse;

class Proveedor extends BaseController
{
    /**
     * Retorna la vista con los datos de proveedores
     * @return string
     */
    public function index(): string
    {
        $proveedor = new ProveedorModel();
        $data = [
            'header' => view(name: 'Partials/header'),
            'proveedores' => $proveedor->findAll(),
            'footer' => view(name: 'Partials/footer'),
        ];

        return view("Modulos/proveedores/index", $data);
    }

    /**
     * Retorna la vista para el registro de proveedores
     * @return string
     */
    public function create(): string
    {
        $data = [
            'header' => view(name: 'Partials/header'),
            'footer' => view(name: 'Partials/footer'),
        ];

        return view('Modulos/proveedores/registrar', $data);
    }


    
    public function buscar(int $id = null)
{
    $cliente = new ProveedorModel();
    $registro = $cliente->find($id);

    $data = [
        'header'   => view(name: 'Partials/header'),
        'registro' => $registro,
        'footer'   => view(name: 'Partials/footer'),
    ];

    return view('Modulos/proveedores/actualizar', $data);
}

public function actualizar(): RedirectResponse
{
    $cliente = new ProveedorModel();

    $cliente->update($this->request->getPost('idproveedor'), [
        'razonsocial' => $this->request->getPost('razonsocial'),
        'direccion'   => $this->request->getPost('direccion'),
        'ruc'          => $this->request->getPost('ruc'),
        'telefono'     => $this->request->getPost('telefono'),
        'representante' => $this->request->getPost('representante'),
    ]);

    return redirect()->to('/proveedores');
}
  

    public function registrarProveedor()
    {
        $proveedor = new ProveedorModel();

        $razonsocial = $this->request->getPost('razonsocial');
        $direccion = $this->request->getPost('direccion');
        $ruc = $this->request->getPost('ruc');
        $telefono = $this->request->getPost('telefono');
        $representante = $this->request->getPost('representante');

        $proveedor->insert([
            'razonsocial' => $razonsocial,
            'direccion' => $direccion,
            'ruc' => $ruc,
            'telefono' => $telefono,
            'representante' => $representante
        ]);

        return redirect()->to('/proveedores');
    }


    /**
     * Summary of eliminar
     * @param mixed $id
     * @return \CodeIgniter\HTTP\RedirectResponse
     */

    public function eliminar($id = null)
    {
        $cliente = new ProveedorModel();
        $cliente->delete($id);
        return redirect()->to('/proveedores');
    }
}