<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table            = 'assessment_answers';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['assessment_id', 'indicator_id', 'skor'];
}