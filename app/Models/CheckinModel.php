<?php namespace App\Models;

use CodeIgniter\Model;

class CheckinModel extends Model
{

	protected $table      = 'checkin';
    protected $primaryKey = 'id_checkin';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_user', 'lat', 'longt'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}