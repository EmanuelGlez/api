<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'users';
    protected $prymaryKey = 'id';
    protected $allowedFields = ['nombre', 'apellidos', 'correo', 'user', 'password'];
} 
