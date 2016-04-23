<?php
namespace Acme\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
  public function testimoni()
  {
      return $this->hasMany('Acme\models\Testimoni');
  }

    public function abcd(){
        return 'pulamea';
    }
}
