<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Role extends Model implements ContractsAuditable
{
    use Auditable;
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
