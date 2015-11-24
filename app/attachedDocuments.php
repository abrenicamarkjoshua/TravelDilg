<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class attachedDocuments extends Model{
	protected $table = 'attacheddocuments';
	protected $fillable = ['name', 'categories', 'location', 'travelApplication_id', 'created_at', 'updated_at','remarks'];
}
?>