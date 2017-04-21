<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TicketModel;
use DB;

class ticketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tickets =  \DB::table('tickets')
                  ->where('estado', '=', 'abierto')
                  ->get();
        return response()->json($tickets);
        //return view('ticket.index')->with('tickets',$tickets);
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
    public function store()
    {
        //
        $resultado = file_get_contents('php://input');
        $resultadoJson = json_decode($resultado);


        $ticket =new TicketModel();
        $ticket->nombre_usuario = $resultadoJson->nombre;
        $ticket->correo_usuario= $resultadoJson->correo;
        $ticket->solicitud =$resultadoJson ->solicitud;
        $ticket->estado = $resultadoJson->estado;

        $ticket->save();

        return response()->json("ticket agregado");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
        $tickets = TicketModel::findOrFail($id);
        return response()->json($tickets);
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
    public function update($id)
    {
        //
        $resultado = file_get_contents('php://input');
        $resultadoJson = json_decode($resultado);
        //$ticket =new TicketModel();
        $ticket = TicketModel::find($id);

        $ticket->nombre_usuario = $resultadoJson->nombre_usuario;
        $ticket->correo_usuario= $resultadoJson->correo_usuario;
        $ticket->solicitud =$resultadoJson ->solicitud;
        $ticket->estado = $resultadoJson->estado;

        $ticket->save();

        return response()->json("ticket editado");
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

    public function cambiarEstadoTicket($id, $estado){

    }

    public function listarTicketCerrado(){
      
      $tickets =  \DB::table('tickets')
                ->where('estado', '=', 'cerrado')
                ->get();
      return response()->json($tickets);
    }


}
