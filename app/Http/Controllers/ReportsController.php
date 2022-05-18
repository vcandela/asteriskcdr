<?php

namespace App\Http\Controllers;

use App\Models\CDRAsterisk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function cdr_details()
    {
        $f1 = Carbon::now()->startOfMonth(); $end = Carbon::now();
        $f1 = date('Y-m-d', strtotime($f1));

        $fecha1 = $f1;
        $fecha2 = date('Y-m-d');
        $fechas = array(
            "fecha1" => $f1,
            "fecha2" => date('Y-m-d'),
        );
        $registros=NULL;
        $tcdr = 0;
		return view('cdr',compact('fechas','registros','tcdr'));

        # code...
    }

    public function cdr_search_details(Request $request){
        $fechaI = $request->form_fecha1;
        $fechaF = date('Y-m-d', strtotime($fechaI));

        $fecha1 = $request->form_fecha1;
        $fecha2 = $request->form_fecha2;

        $fechas = array(
            "fecha1" => $request->form_fecha1,
            "fecha2" => $request->form_fecha2,
        );

        $fecha1 = date('Y-m-d', strtotime($fecha1)) . " 00:00:00";
        $fecha2 = date('Y-m-d', strtotime($fecha2)) . " 23:59:59";

        $registros = CDRAsterisk::whereBetween('calldate',[$fecha1, $fecha2])
                                ->orderBy('calldate','DESC')
                                ->get();

		$tcdr = count($registros);

		return view('cdr',compact('fechas','registros','tcdr'));
    }
}
