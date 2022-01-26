<?php

namespace App\Http\Controllers\Panel;

use App\Models\IdeRango;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patron;
use App\Models\RangoDeriva;
use Symfony\Component\HttpFoundation\Response;


class IdeRangoController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdeRango  $ideRango
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deriva = IdeRango::with('patronIde.patron', 'rangoDerivas')->whereId($id)->first();
        return view('panel.patrones.ide.deriva', compact('deriva'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdeRango  $ideRango
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IdeRango::destroy($id);
        return response()->json(Response::HTTP_OK);
    }




    #Deriva Controller -------------------------------------------------------------------------

    public function insertDeriva(Request $request){
        $deriva = RangoDeriva::create($this->validateDeriva());
        return response()->json($deriva);
    }

    public function updateDeriva(Request $request, $id){
        $deriva = RangoDeriva::findOrFail($id);
        $deriva->update($this->validateDeriva());
        return response()->json($deriva);
    }

    public function destroyDeriva($id){
        $deriva = RangoDeriva::findOrFail($id);
        $deriva->delete();
        return response()->json(Response::HTTP_OK);
    }


    public function ocultar(Request $request){
        $deriva = RangoDeriva::findOrFail($request->id);
        $deriva->oculto = $deriva->oculto ? 0 : 1;
        $deriva->save();
        return response()->json($deriva);
    }

    public function validateDeriva()
    {
        return request()->validate([
            'ip'           => 'required',
            'u'            => 'required',
            'k'            => 'required',
            'uc'           => 'required',
            'e_actual'     => 'required',
            'e_anterior'   => 'nullable',
            'deriva'       => 'required',
            'ide_rango_id' => 'required',
            'oculto'       => 'nullable'
        ]);
    }



}
