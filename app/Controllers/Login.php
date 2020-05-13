<?php namespace App\Controllers;
use App\Models\LoginModel;

const REGISTER_TITLE = 'Todo - Register';
class Login extends BaseController
{
    public function index(){
        $data['title'] = 'Todo - Login';
        echo view('templates/header',$data);
        echo view('login/login', $data);
        echo view('templates/footer', $data);
    }
    
   public function register(){
        $data['title'] = REGISTER_TITLE;
        $model = new LoginModel();
        echo view('templates/header', ['title' => 'Register']);
        echo view('login/register');
        echo view('templates/footer');
            
    }
    
    public function registration(){
        $model = new LoginModel();
        
        if(!$this->validate([
            'user' => 'required|min_length[8]|max_length[30]',
            'password' => 'required|min_length[8]|max_length[30]',
            'confirmpassword' => 'required|min_length[8]|max_length[30]|matches[password]',
        ])){
            echo view('templates/header' , ['title' => REGISTER_TITLE]);
            echo view('login/register');
            echo view('templaets/footer');
        }
        else{
            $model->save([
                'username' => $this->request->getVar('user'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'firstname' => $this->request->getVar('fname'),
                'lastname' => $this->request->getVar('lname')
            ]);
            return redirect('login');
        }
    }
}