<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\JobDataResource;
use App\Http\Resources\RealestateResource;
use App\Http\Traits\Api\Job\Register\Register;
use App\Http\Traits\Api\Job\Realestate\RealestateAdapter;
use App\Http\Traits\Api\Job\SetRealestateDataInTransactionmode;


class JobController extends Controller
{
    use Register;
    use RealestateAdapter, SetRealestateDataInTransactionmode;
    
    public function job(Request $request)
    {
        /* angaben um welchen Job es sich handelt und dazugehörigen Daten */
        $jobData = New JobDataResource($request);
        /* auswahl des Jobs und anschliessende Bearbeitung  */
        if($jobData['job']=='register')
        {
            dd($jobData['data']);
            $data = new UserResource($jobData['data']);
            return $this->register($data->resource) ;
        }elseif($jobData['job']=='realestate'){
            /* Realestate-Resoource wird erzeugt*/
            $res = new RealestateResource($jobData['data']);
            /* Filtern der Daten welche zu weiterer Verwendung benötig werden*/
            $data = $res->toArray($res->resource);
            /* Verarbeitn der Daten */
            $retval = $this->importRealestate($data);
            return response()->json($retval);
        }elseif($jobData['job']=='setIntransactionMode'){
            /* Alle Daten einer Tabele werden in synchronisationsstatus versetzt oder aufgehoben */
            $retval = $this->SetRealestateDataInTransactionmode($jobData['data']);
            return response()->json($retval);
        }elseif($jobData['job']=='deleteUserVerbrauchsinfoAccessControl'){
            /* Daten mit TryWebDelete werden entfernt */
            $retval = $this->deleteUserVerbrauchsinfoAccessControl($jobData['data']);
            return response()->json($retval);
        }elseif($jobData['job']=='deleteVerbrauchsinfoUserEmail'){
            $retval = $this->deleteVerbrauchsinfoUserEmail($jobData['data']);
            return response()->json($retval);
        }else {
            /* Fehlermeldung falls ein Job unbekannt ist */
            return response()->json([
                'function' => 'JobController.job',
                'result' => 'error',
                'error' => $jobData['job']. ' wurde nicht implementiert',
        ]);
        }

    }
}

