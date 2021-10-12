<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerHomeModel extends Model
{
    protected $table      = 'bannerhome';
    protected $primaryKey = 'ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Titulo', 'Subtitulo', 'Imagem', 'LinkRegras', 'LinkGuias', 'LinkAjuda', 'Ativo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}