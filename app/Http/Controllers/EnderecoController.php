<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view("endereco.create", ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $endereco  = new Endereco;
        $endereco->n_casa = $request->n_casa;
        $endereco->rua = $request->rua;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->fk_cliente = $request->fk_cliente;

        $endereco->save();

        return redirect('/pedido/create/' . $endereco->fk_cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $endereco = DB::table('endereco')->where('fk_cliente', $id)->first();
        return view("endereco.edit", ['id' => $id, 'endereco' => $endereco]);
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
        $endereco_chave = DB::table('endereco')->where('fk_cliente', $id)->first();
        $pk_endereco = $endereco_chave->pk_endereco;

        $endereco = Endereco::find($pk_endereco);
        $endereco->n_casa = $request->n_casa;
        $endereco->rua = $request->rua;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->save();

        return redirect('/listar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
