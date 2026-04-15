<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentModel extends Model
{
    protected $table            = 'assessments';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'campus_id', 
        'score_e1', 'score_e2', 'score_e3', 'score_e4',
        'ws_e1', 'ws_e2', 'ws_e3', 'ws_e4',
        'total_ri', 'ri_100', 'maturity_level'
    ];
    protected $useTimestamps    = true; 
}