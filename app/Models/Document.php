<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['extension', 'name', 'category', 'url'];
    protected $appends = [ 'icon'];

    public function document(){
        return $this->morphTo();
    }

    public function getIconAttribute(){
        switch($this->attributes['extension']){
            case 'pdf':
                return 'fa-file-pdf';
            case 'xlsx':
                return 'fa-file-excel';
            case 'doc':
                return 'fa-file-word';
            case 'docx':
                return 'fa-file-word';
            case 'xls':
                return 'fa-file-excel';
            default:
                return 'fa-file';
        }
    }

    public function getUrlAttribute(){
       // $ruta = '';

        // switch($this->attributes['document_type']){
        //     case 'App\Models\Procedimiento': $ruta = 'procedimientos'; break;
        //     case 'App\Models\Patron': $ruta = 'patrones'; break;
        //     case 'App\Models\Equipo': $ruta = 'equipos'; break;
        // }

        return asset($this->attributes['url'].$this->attributes['name']);
    }


}
