<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class TipoIdentificacionService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the tipoIdentificacion service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the tipoIdentificacion service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.ventas.base_uri');
        $this->secret = config('services.ventas.secret');
    }
    public function index()
    {
        return $this->performRequest('GET', '/tipoIdentificacion');
    }
    public function store($data)
    {
        return $this->performRequest('POST', '/tipoIdentificacion', $data);
    }
    public function update($data, $id)
    {
        return $this->performRequest('PUT', "/tipoIdentificacion/{$id}", $data);
    }
    public function delete($id)
    {
        return $this->performRequest('DELETE', "/tipoIdentificacion/{$id}");
    }
}
