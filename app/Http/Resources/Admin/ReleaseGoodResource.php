<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ReleaseGoodResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);

        //$releasegoodconvenience = $this->has_releasegoodconvenience ? $this->releasegoodconvenience : NULL;
      /*  return [
            'date_sorti_prevu' => $this->date_sorti_prevu,
            //'releasegoodconvenience' => !empty($releasegoodconvenience) ? self::collection($releasegoodconvenience) : NULL,
       ]; */
    }
}
