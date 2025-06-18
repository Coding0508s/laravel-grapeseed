<?php 
namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 
class Test extends Model { protected $connection = 'ash_test'; 
    protected $table = 'test'; public $timestamps = false; }