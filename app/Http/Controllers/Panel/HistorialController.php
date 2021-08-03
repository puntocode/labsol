<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Historycalibration;
use App\Models\Historymaintenance;
use Illuminate\Http\Request;

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

  }
