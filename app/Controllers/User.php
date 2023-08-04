<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        //obtener todos 
        $model = new UserModel();
        $data =  $model->findall();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        //obtener uno
        $model = new UserModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No existe algún dato con ese ID');
        }
    }

    public function create()
    {
        //crear nuevo
        $model = new UserModel();
        $recuest = $this->request->getJSON();
        /*echo var_dump($recuest);  //Comprobamos la recuperacion correcta del JSON  */
       /* $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellidos' => $this->request->getPost('apellidos'),
            'correo' => $this->request->getPost('correo'),
            'user' => $this->request->getPost('user'),
            'password' => $this->request->getPost('password')
        ];  
        //Esta creacion de objeto se crea cuando biene del formulario y no de un servicio
        */
        $model->insert($recuest);
        $response = [
            'status' => 201, 
            'error' => null,
            'messages' => [
                'success' => 'Se creo correctamente'
            ]
            ];

        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        //actualizar un objeto
        $model = new UserModel();
        $recuest = $this->request->getJSON();
        $model->update($id, $recuest);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
            ];
        return $this->respondUpdated($response);
    }
     
    public function delete($id = null)
    {
        //eliminar
        $model = new UserModel();
        $model->delete(2);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Delete'
            ]
            ]; 
            return $this->respondDeleted($response);
    }

}
