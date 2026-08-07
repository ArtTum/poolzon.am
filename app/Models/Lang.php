<?php
/**
 * Created by PhpStorm.
 * User: artur999
 * Date: 12/2/2018
 * Time: 1:04 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $table = 'lang';
    const LANG_ARM = 1;
    const LANG_RU = 2;
}
