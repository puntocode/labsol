<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Historycalibration;
use App\Models\Historymaintenance;
use App\Http\Controllers\Controller;


class HistorialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.historial.index');
    }

    #Historial de Calibracion ------------------------------------------------------------------
    public function getHistoryCalibration($id)
    {
        return response()->json(Historycalibration::whereId($id)->first());
    }


    public function updateCalibrationHistory(Request $request)
    {
       $history = Historycalibration::whereId($request->id)->update($this->validateHistorial());
       return response()->json($history);
    }


    public function validateHistorial()
    {
        return request()->validate([
            'id'               => 'required|numeric',
            'certificate_no'   => 'required',
            'done'             => 'required',
            'calibration'      => 'nullable',
            'next_calibration' => 'nullable',
            'obs'              => 'nullable',
        ]);
    }


    #Historial de Mantenimiento ------------------------------------------------------------------
    public function getHistoryMaintenance($id)
    {
        return response()->json(Historymaintenance::whereId($id)->first());
    }


    public function updateHistoryMaintenance(Request $request)
    {
       $history = Historymaintenance::whereId($request->id)->update($this->validateMaintenance());
       return response()->json($history);
    }


    public function validateMaintenance()
    {
        return request()->validate([
            'id'               => 'required|numeric',
            'description'      => 'required',
            'done'             => 'required',
            'reason'           => 'nullable',
            'maintenance_date' => 'nullable',
            'next_maintenance' => 'nullable',
            'obs'              => 'nullable',
        ]);
    }


    #cargar documento -------------------------------------------------------------------------------
    public function cargarDocumento($request){
        $file = $request->file('documento')->getClientOriginalName();
        $extension = $request->documento->guessExtension();
        $slug = Str::slug(pathinfo($file,PATHINFO_FILENAME));
        $nombreArchivo = $slug.".".$extension;
        $url = 'media/docs/'.$request->header('folder');
        $request->documento->move(public_path($url), $nombreArchivo);
        return $nombreArchivo;
    }

  }
