<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['extension', 'name', 'category', 'url'];
    protected $appends  = ['icon'];

    public function document(){
        return $this->morphTo();
    }

    public function getIconAttribute(){
        switch($this->attributes['extension']){
            case 'pdf':  return 'fa-file-pdf';   break;
            case 'xlsx': return 'fa-file-excel'; break;
            case 'doc':  return 'fa-file-word';  break;
            case 'docx': return 'fa-file-word';  break;
            case 'xls':  return 'fa-file-excel'; break;
            default:     return 'fa-file';       break;
        }
    }

    public function getUrlAttribute(){
        return asset($this->attributes['url'].$this->attributes['name']);
    }

    public function getCreatedAtAttribute($date){
        return date('d/m/Y', strtotime($date));
    }

}
