<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public $preserveKeys = true;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'controle' => $this->controle,
            'exam' => $this->exam,
            'element' => $this->element->nom,
            'module' => $this->element->module->nom,
            'semestre' => $this->element->module->semestre,
        ];
    }
}
