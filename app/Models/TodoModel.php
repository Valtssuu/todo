<?php namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'task';
    
    protected $allowedFields = ['title', 'description'];
    
    public function getTodos(){
        return $this->findAll();
    }
}