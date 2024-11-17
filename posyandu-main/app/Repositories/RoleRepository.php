<?php

namespace App\Repositories;

use App\Models\Role;
use DB;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class RoleRepository extends BaseRepository
{

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
