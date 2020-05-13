<?php namespace App\Controllers;
use App\Models\TodoModel;

class Todo extends BaseController
{
    public function index()
    {
        $model = new TodoModel();
        $data['title'] = 'Todo';
        $data['todos'] = $model->getTodos();
        
        echo view('templates/header', $data);
        echo view('todo/list', $data);
        echo view('templates/footer', $data);
    }
    
    public function create(){
        $model = new TodoModel();
        
        if(!$this->validate([
            'title' => 'required|max_length[255]',
        ])){
            echo view('templates/header', ['title' => 'Add new task']);
            echo view('todo/create');
            echo view('templates/footer');
            
        }
        else{
            $model->save([
               'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description')
            ]);
            return redirect('todo');
        }
    }
}