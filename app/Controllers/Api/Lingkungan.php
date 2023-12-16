<?php

namespace app\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\LingkunganModel;

class Lingkungan extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new LingkunganModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $model = new LingkunganModel();
        // $data = $model->getWhere(['id_lingkungan' => $id])->getResult();
        $data = $model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    public function create()
    {
        $model = new LingkunganModel();
        $id = $model->kodegenLingkungan();
        $data = [
            'id_lingkungan' => $id,
            'nama' => $this->request->getVar('nama')
        ];
        // $data = json_decode(file_get_contents("php://input"));
        // $data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);
    }

    public function update($id = null)
    {
        $model = new LingkunganModel();
        $json = $this->request->getJSON();
        if ($json) {
            $data = [
                'id_lingkungan' => $json->id_lingkungan,
                'nama' => $json->nama
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'id_lingkungan' => $input['id_lingkungan'],
                'nama' => $input['nama']
            ];
        }
        // Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new LingkunganModel();
        $data = $model->where('id_lingkungan', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No employee found');
        }
    }
}
