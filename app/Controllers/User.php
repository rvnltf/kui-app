<?php

namespace App\Controllers;

class User extends BaseController
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'title' => "KUI - Mahasiswa"
        ];
    }

    public function index()
    {
        return view('user/index', $this->data);
    }

    public function profile()
    {
        return view('user/profile', $this->data);
    }

    public function updateProfile()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'fullname' => [
                    'label' => 'Fullname',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                // 'email' => [
                //     'label' => 'Email',
                //     'rules' => 'required|valid_email|is_unique[users.email]',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong',
                //         'valid_email' => '{field} tidak valid',
                //         'is_unique' => '{field} telah terdaftar',
                //     ]
                // ],
                'nim' => [
                    'label' => 'NIM',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} telah terdaftar',
                    ]
                ],
                // 'username' => [
                //     'label' => 'Username',
                //     'rules' => 'required|is_unique[users.username]',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong',
                //         'is_unique' => '{field} telah terdaftar',
                //     ]
                // ],
                'prodi' => [
                    'label' => 'Program Studi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'fullname' => $validation->getError('fullname'),
                        // 'email' => $validation->getError('email'),
                        'nim' => $validation->getError('nim'),
                        // 'username' => $validation->getError('username'),
                        'prodi' => $validation->getError('prodi'),
                    ]
                ];
            } else {
                $simpanData = [
                    'fullname' => $this->request->getVar('fullname'),
                    // 'email' => $this->request->getVar('email'),
                    'nim' => $this->request->getVar('nim'),
                    // 'username' => $this->request->getVar('username'),
                    'prodi' => $this->request->getVar('prodi'),
                ];

                $profile = new \Myth\Auth\Models\UserModel();

                $profile->update($this->request->getVar('id'), $simpanData);

                $msg = [
                    'success' => 'Data telah berhasil diperbaharui.'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function uploadImg()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'user_img' => [
                    'label' => 'Image',
                    'rules' => 'uploaded[user_img]|is_image[user_img]|max_size[user_img,1024]',
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'user_img' => $validation->getError('user_img')
                    ]
                ];
            } else {

                $dataBerkas = $this->request->getFile("user_img");
                $ext = $dataBerkas->getClientExtension();
                $fileName = "IMG-" . date('YmdHis') . "." . $ext;

                $simpanData = [
                    'user_img' => $fileName,
                ];

                $profile = new \Myth\Auth\Models\UserModel();

                $profile->update($this->request->getVar('id'), $simpanData);

                $dataBerkas->move(ROOTPATH . 'public/img/', $fileName);

                $msg = [
                    'success' => 'Image has been uploaded.'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function studentExchanges()
    {
        return view('user/studentExchanges', $this->data);
    }

    public function getFaculty()
    {
        if ($this->request->isAJAX()) {
            $studentExchange = new \App\Models\StudentAppliedModel();
            $fadep = new \App\Models\FadepModel();
            $data = [
                "fadep" => $fadep->getStudentExchange(user()->mhs),
                "exchange" => $studentExchange->where('id_user', user()->id)->first(),
                "exchanges" => $studentExchange->findAll()
            ];
            $message = [
                "data" => view("user/facultyData", $data)
            ];
            echo json_encode($message);
        }
    }

    public function appliedExchange()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'berkas' => [
                    'label' => 'File',
                    'rules' => 'uploaded[berkas]|ext_in[berkas,zip]|max_size[berkas,10240]',
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'berkas' => $validation->getError('berkas')
                    ]
                ];
            } else {
                $dataBerkas = $this->request->getFile("berkas");
                $ext = $dataBerkas->getClientExtension();
                $fileName = "SE-" . date('YmdHis') . "." . $ext;

                $simpanData = [
                    'id_fakultas' => $this->request->getVar('id_fakultas'),
                    'id_departement' => $this->request->getVar('id_departement'),
                    'id_user' => $this->request->getVar('id_user'),
                    'status' => 1,
                    'file' => $fileName,
                ];

                $student = new \App\Models\StudentAppliedModel();

                $dataBerkas->move(ROOTPATH . 'public/StudentExchange/', $fileName);

                $student->insert($simpanData);

                $msg = [
                    'success' => 'Data telah berhasil tersimpan.'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function modalUpload()
    {
        if ($this->request->isAJAX()) {

            $fakultas = new \App\Models\FakultasModel();
            $departement = new \App\Models\DepartementModel();
            $format = new \App\Models\SettingsModel();

            $data = [
                'id_fakultas' => $this->request->getVar('id_fakultas'),
                'id_departement' => $this->request->getVar('id_departement'),
                'fakultas' => $fakultas->find($this->request->getVar('id_fakultas')),
                'departement' => $departement->find($this->request->getVar('id_departement')),
                'file_format' => $format->getSetting('file_format')
            ];

            $message = [
                "data" => view("user/modalUpload", $data)
            ];
            echo json_encode($message);
        }
    }
}
