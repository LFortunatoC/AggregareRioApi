<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable =['id','client_id', 'picturePath','logoPath','defaultLang','active'];

    public function language() {
        return $this->hasOne('App\Language', 'id', 'defaultLang');
    } 

    public function titleAndDescriptions() {
        return $this->hasMany('App\MenuTitleDesc', 'menu_id', 'id');
    }
}
