<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class Tag extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
}
