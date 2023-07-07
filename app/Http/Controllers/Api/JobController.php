<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\JobDataResource;
use App\Http\Resources\RealestateResource;
use App\Http\Traits\Api\Job\Register\Register;
use App\Models\UserVerbrauchsinfoAccessControl;
use App\Http\Traits\Api\Job\Realestate\ImportRealestate;
use App\Http\Traits\Api\Job\SetRealestateDataInTransactionmode;


class JobController extends Controller
{
    use Register;
    use ImportRealestate, SetRealestateDataInTransactionmode;
    
    public function job(Request $request)
    {
        /* angaben um welchen Job es sich handelt und dazugehörigen Daten */
        $jobData = New JobDataResource($request);
        /* auswahl des Jobs und anschliessende Bearbeitung  */
        if($jobData['job']=='register')
        {
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
            /* Realestate-Resoource wird erzeugt*/
            $retval = $this->SetRealestateDataInTransactionmode($jobData['data']);
            return response()->json($retval);
        }elseif($jobData['job']=='deleteUserVerbrauchsinfoAccessControl'){
            $retval = $this->deleteUserVerbrauchsinfoAccessControl($jobData['data']);
            return response()->json($retval);
        }elseif($jobData['job']=='deleteVerbrauchsinfoUserEmail'){
            
         
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

