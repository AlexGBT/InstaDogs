<?php


namespace App\Repositories;

use App\Profile;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

class ProfileRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Profile::class;
    }


}
