<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class travelflight extends Model{
	protected $table = 'travelflight';
	 protected $fillable = [
		"country",
		"datefrom",
		"travelApplication_id",
		"dateto",
		"benefits",
		"groupdelegation",
		"natureoftravelrequested",
		"traveltype",
		"entitlementsrequested",
		"undertravelallowance"
	 ];
	 
}
?>