<?php

namespace App\Repositories;


use App\Models\User;
use DB;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class UserRepository extends BaseRepository
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
