<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormaPagoController extends Controller
{
    public function __construct()
    {
        //['index','noticias']
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formapago = FormaPago::get();
        return $formapago;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $this->validate(request(), [
            'nomb_formapago' => 'required|string'
        ]);
        if ($v) {
            $formulario = new FormaPago();
            $formulario->create($request->all());
            return;
        } else {
            return back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = $this->validate(request(), [
            'nomb_formapago' => 'required|string'
        ]);
        if ($v) {
            $id_emp  =  $request->input('id_emp');
            $id_fec  =  $request->input('id_fec');
            $nomb_formapago  =  $request->input('nomb_formapago');
            $observ_formapago  =  $request->input('observ_formapago');
            $estado_formapago  =  $request->input('estado_formapago');

            DB::table('formapago')
                ->where('id_formapago', $id)
                ->update(
                    [
                        'id_emp' => $id_emp, 'nomb_formapago' => $nomb_formapago, 'observ_formapago' => $observ_formapago,
                        'estado_formapago' => $estado_formapago
                    ]
                );
            return;
        } else {
            return back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado_formapago = 'I';
        DB::table('formapago')
            ->where('id_formapago', $id)
            ->update(
                ['estado_formapago' => $estado_formapago]
            );
        return;
    }
}
