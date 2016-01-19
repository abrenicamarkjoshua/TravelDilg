<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class orderofapproval extends Model{
	protected $table = 'orderofapproval';
	protected $fillable = ['department_id', 'description', 'status_id', 'accounttype_ID'];
}
?>