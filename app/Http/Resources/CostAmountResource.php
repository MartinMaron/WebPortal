<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CostAmountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'bemerkung'=> $this['bemerkung'],
            'tryWebDelete'=> $this['tryWebDelete'],
            'description'=> $this['description'],
            'netAmount'=> $this['netAmount'],
            'grosAmount'=> $this['grosAmount'],
            'dateCostAmount'=> $this['dateCostAmount'],
            'consumption'=> $this['consumption'],
            'grosAmount_HH'=> $this['grosAmount_HH']
        ];
    }
}
