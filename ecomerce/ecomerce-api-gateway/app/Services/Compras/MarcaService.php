<?php

namespace App\Services\Compras;

use App\Traits\ConsumesExternalService;

class MarcaService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the marcas service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the marcas service
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
        return $this->performRequest('GET', '/marcas');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/marcas', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/marcas/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/marcas/{$id}");
    }

}
