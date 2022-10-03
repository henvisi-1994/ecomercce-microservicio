<?php

namespace App\Services\Compras;

use App\Traits\ConsumesExternalService;

class ProductoService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the productos service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the productos service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.compras.base_uri');
        $this->secret = config('services.compras.secret');
    }
    public function index()
    {
        return $this->performRequest('GET', '/productos');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/productos', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/productos/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/productos/{$id}");
    }
    public function getProductActivos(){
        return $this->performRequest('GET', '/productos/activos');
    }
    public function getProductoCategoria($id){
        return $this->performRequest('GET', "/productos/categoria/{$id}");
    }

}
