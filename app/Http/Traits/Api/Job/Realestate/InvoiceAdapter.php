<?php 
namespace App\Http\Traits\Api\Job\Realestate;

use App\Models\Invoice;
use App\Models\Realestate;
use Illuminate\Support\Facades\DB;
use App\Models\VerbrauchsinfoUserEmail;

Trait InvoiceAdapter
{
    
    
    public function importInvoice(Array $data, Realestate $realestate)    {

     

        /* Validierung der Daten vor Anlage  */
        $validator = Invoice::validateImportData($data);
        if ($validator->fails()) {
            return [
                'function' => 'JobController.importInvoice',
                'result' => 'error',
                'errortype' => 'invalid data',
                'errors' => $validator->errors(),
                'data' => $data,
                'id' => 0
                ];
        }
   
   
         /* Anlage der Emailsteuerungstabelle für Verbraucherinformationen */
        $importObj = Invoice::updateOrcreate(
            [
                'nekoId' => $data['nekoId']
            ],
            [
                'nekoId' => $data['nekoId'],
                'createDate' => $data['createDate'],
                'caption' => $data['caption'],
                'description' => $data['description'], 
                'fileName' => $data['fileName'],
                'dateFrom' => $data['dateFrom'],
                'dateTo' => $data['dateTo'],
                'vertragsart' => $data['vertragsart'],
                'bezahlt' => $data['bezahlt'],
                'bezahltAm' => $data['bezahltAm'],
                'zahlungsAuftragDatum' => $data['zahlungsAuftragDatum'],
                'zahlungsauftragIBAN' => $data['zahlungsauftragIBAN'],
                'netto' => $data['netto'],
                'vat' => $data['vat'],
                'brutto' => $data['brutto'],
                'realestate_id' => $realestate->id,
            ]
        );
   
        return [
            'function' => 'JobController.importInvoice',
            'result' => 'success',
            'id' => $importObj->id,
        ];
   
    }

    public function deleteInvoice($data){
          /* extrahieren der Daten */
          $neko_id = $data;
          $result = DB::table('invoices')->where('nekoId', $neko_id)->delete();

          if($result==1)
          {
              return response()->json([
                  'function' => 'JobController.job.deleteInvoice',
                  'result' => 'success',
                  'id' => $neko_id,
                  'data' => $data,
              ]);
          }else {
              /* Fehlermeldung falls ein Job unbekannt ist */
              return response()->json([
                  'function' => 'JobController.job',
                  'result' => 'error',
                  'error' => ' datensatz existiert nicht mehr oder konnte nicht gelöscht werden',
              ]);
          }       
        
    }

}