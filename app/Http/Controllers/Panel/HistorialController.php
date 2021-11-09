<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Historycalibration;
use App\Models\Historymaintenance;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Equipo;
use App\Models\Patron;
use Symfony\Component\HttpFoundation\Response;


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
        $history = Historycalibration::whereId($request->id)->first();
        $history->update($this->validateHistorial());
        $this->actualizarNroCertificado($history);
        return response()->json($history);
    }


    public function actualizarNroCertificado($history)
    {
        $ultimoHistorial = Historycalibration::where('historycalibration_id', $history->historycalibration_id)
            ->where('historycalibration_type', $history->historycalibration_type)
            ->orderBy('created_at', 'DESC')->first();

        if($ultimoHistorial->id === $history->id){
            if($ultimoHistorial->historycalibration_type == 'App\Models\Patron') $modelo = Patron::whereId($ultimoHistorial->historycalibration_id);
            else $modelo = Equipo::whereId($ultimoHistorial->historycalibration_id);

            $modelo->update(['certificate_no' => $ultimoHistorial->certificate_no]);
        }

        return;
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
    public function storeCertificate(Request $request, $id)
    {
        $file = $request->file('certificate')->getClientOriginalName();
        $extension = $request->certificate->guessExtension();
        $slug = Str::slug(pathinfo($file,PATHINFO_FILENAME));
        $nombreArchivo = $slug.".".$extension;
        $url = 'media/docs/historial-calibracion';

        $request->certificate->move(public_path($url), $nombreArchivo);

        $historial = Historycalibration::findOrFail($id);
        $historial->certificate = $nombreArchivo;
        $historial->save();

        return response()->json($historial);
    }


    public function deleteCertificate($id){
        $history = Historycalibration::findOrFail($id);
        $path = public_path()."/media/docs/historial-calibracion/".$history->certificate;
        unlink($path);
        $history->certificate = null;
        $history->save();
        return response()->json(Response::HTTP_OK);
    }


    #eliminar --------------------------------------------------------------------------------------
    public function destroyCalibracion($id)
    {
        $history = Historycalibration::whereId($id)->first();
        if($history->certificate) $this->deleteCertificate($id);
        $history->delete();
        return response()->json(Response::HTTP_OK);
    }

    public function destroyMaintenance($id)
    {
        $history = Historymaintenance::whereId($id)->first();
        $history->delete();
        return response()->json(Response::HTTP_OK);
    }

    public function destroyDocument(Request $request)
    {
        $history = Document::whereId($request['id'])->first();
        $history->delete();
        return response()->json(Response::HTTP_OK);
    }


  }
