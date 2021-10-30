<?php

namespace App\Models;

use CodeIgniter\Model;

class ConteudoPublicacaoModel extends Model
{
    protected $table      = 'conteudopublicacao';
    protected $primaryKey = 'ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Titulo', 'Conteudo', 'IDPublicacao'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}