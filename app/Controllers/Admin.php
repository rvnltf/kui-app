<?php

namespace App\Controllers;

use App\Models\FakultasModel;
use Config\Services;

class Admin extends BaseController
{
    protected $data;

    public function __construct()
    {
        $this->data = [
            'title' => "KUI - Administrator"
        ];
    }

    public function index()
    {
        return view('admin/index', $this->data);
    }
    public function exchange()
    {
        return view('admin/exchange', $this->data);
    }
    public function appliedPrograms()
    {
        return view('admin/appliedPrograms', $this->data);
    }
    public function departement()
    {
        $departement = new \App\Models\DepartementModel();
        $this->data["departement"] = $departement->findAll();

        return view('admin/departement', $this->data);
    }
    public function verificationUser()
    {
        $user = new \Myth\Auth\Models\UserModel();
        $this->data["users"] = $user->findAll();

        return view('admin/verificationUser', $this->data);
    }

    public function getUser()
    {
        if ($this->request->isAJAX()) {
            $users = new \Myth\Auth\Models\UserModel();
            $data = [
                "users" => $users->findAll()
            ];
            $message = [
                "data" => view("admin/dataUser", $data)
            ];
            echo json_encode($message);
        }
    }

    public function getFakultas()
    {
        if ($this->request->isAJAX()) {
            $fakultas = new \App\Models\FakultasModel();
            $exchange = new \App\Models\StudentAppliedModel();

            $data = [
                "fakultas" => $fakultas->findAll(),
                "exchange" => $exchange->findAll()
            ];
            $message = [
                "data" => view("admin/dataFakultas", $data)
            ];
            echo json_encode($message);
        }
    }

    public function getExchange()
    {
        if ($this->request->isAJAX()) {
            $exchange = new \App\Models\StudentAppliedModel();
            $status = new \App\Models\StatusModel();
            $data = [
                "exchange" => $exchange->getStudentApplied(),
                "status" => $status->findAll()
            ];
            $message = [
                "data" => view("admin/dataExchange", $data)
            ];
            echo json_encode($message);
        }
    }

    public function getDepartement()
    {
        if ($this->request->isAJAX()) {
            $departement = new \App\Models\DepartementModel();
            $data = [
                "departement" => $departement->findAll()
            ];
            $message = [
                "data" => view("admin/dataDepartement", $data)
            ];
            echo json_encode($message);
        }
    }

    public function checklistDepartements()
    {
        if ($this->request->isAJAX()) {
            $departements = new \App\Models\DepartementModel();
            $fadep = new \App\Models\FadepModel();
            $data = [
                "departements" => $departements->findAll(),
                "fadep" => $fadep->where('id_fakultas', $this->request->getVar('id'))->findAll(),
                "id_fakultas" => $this->request->getVar('id')
            ];
            $message = [
                "data" => view("admin/checklistDepartement", $data)
            ];
            echo json_encode($message);
        }
    }

    public function formFakultas()
    {
        if ($this->request->isAJAX()) {
            $fakultas = new \App\Models\FakultasModel();
            $data = [
                "fakultas" => $fakultas->where('id', $this->request->getVar('id'))->first()
            ];
            $message = [
                "data" => view("admin/modalFakultas", $data)
            ];
            echo json_encode($message);
        }
    }

    public function editFormat()
    {
        if ($this->request->isAJAX()) {
            $setting = new \App\Models\SettingsModel();
            $data = [
                "file_format" => $setting->getSetting('file_format')
            ];
            $message = [
                "data" => view("admin/modalFormat", $data)
            ];
            echo json_encode($message);
        }
    }

    public function editSetting()
    {
        if ($this->request->isAJAX()) {
            $setting = new \App\Models\SettingsModel();
            $data = [
                "setting" => $setting->getSetting('contact_us')
            ];
            $message = [
                "data" => view("admin/modalSetting", $data)
            ];
            echo json_encode($message);
        }
    }

    public function modalStatus()
    {
        if ($this->request->isAJAX()) {
            $message = [
                "data" => view("admin/modalStatus")
            ];
            echo json_encode($message);
        }
    }

    public function formDepartement()
    {
        if ($this->request->isAJAX()) {
            $departement = new \App\Models\DepartementModel();
            $data = [
                "departement" => $departement->where('id', $this->request->getVar('id'))->first()
            ];
            $message = [
                "data" => view("admin/modalDepartement", $data)
            ];
            echo json_encode($message);
        }
    }

    public function modalDepartements()
    {
        if ($this->request->isAJAX()) {
            $data = [
                "id" => $this->request->getVar('id')
            ];
            $message = [
                "data" => view("admin/modalDepartements", $data)
            ];

            echo json_encode($message);
        }
    }

    public function simpanFakultas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            // print_r($this->request->getVar());

            $valid = $this->validate([
                'fakultas' => [
                    'label' => 'Fakultas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'exp_date' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'ldt' => [
                    'label' => 'LDT',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'kuota' => [
                    'label' => 'Kuota',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'mhs' => [
                    'label' => 'Peruntukan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'fakultas' => $validation->getError('fakultas'),
                        'exp_date' => $validation->getError('exp_date'),
                        'ldt' => $validation->getError('ldt'),
                        'kuota' => $validation->getError('kuota'),
                        'mhs' => $validation->getError('mhs'),
                    ]
                ];
            } else {
                $simpanData = [
                    'fakultas' => $this->request->getVar('fakultas'),
                    'exp_date' => date('Y-m-d', strtotime($this->request->getVar('exp_date'))),
                    'ldt' => $this->request->getVar('ldt'),
                    'kuota' => $this->request->getVar('kuota'),
                    'cost' => $this->request->getVar('cost'),
                    'fakultas_status' => $this->request->getVar('form_fakultas') == 1 ? 1 : 0,
                    'kuota_status' => $this->request->getVar('form_kuota') == 1 ? 1 : 0,
                    'for_exchange' => $this->request->getVar('mhs'),
                ];

                $fakultas = new \App\Models\FakultasModel();

                $fakultas->insert($simpanData);

                $msg = [
                    'success' => 'Data telah berhasil tersimpan.'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateFakultas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'fakultas' => [
                    'label' => 'Fakultas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'exp_date' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'ldt' => [
                    'label' => 'LDT',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'kuota' => [
                    'label' => 'Kuota',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'fakultas' => $validation->getError('fakultas'),
                        'exp_date' => $validation->getError('exp_date'),
                        'ldt' => $validation->getError('ldt'),
                        'kuota' => $validation->getError('kuota'),
                    ]
                ];
            } else {
                $simpanData = [
                    'fakultas' => $this->request->getVar('fakultas'),
                    'exp_date' => date('Y-m-d', strtotime($this->request->getVar('exp_date'))),
                    'ldt' => $this->request->getVar('ldt'),
                    'kuota' => $this->request->getVar('kuota'),
                    'cost' => $this->request->getVar('cost'),
                    'fakultas_status' => $this->request->getVar('form_fakultas') ? 1 : 0,
                    'kuota_status' => $this->request->getVar('form_kuota') ? 1 : 0,
                ];

                $fakultas = new \App\Models\FakultasModel();

                $fakultas->update($this->request->getVar('id'), $simpanData);

                $msg = [
                    'success' => 'Data telah berhasil diperbaharui.'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function toggleFakultas()
    {
        if ($this->request->isAJAX()) {
            $simpanData = [
                'fakultas_status' => $this->request->getVar('data'),
            ];

            $fakultas = new \App\Models\FakultasModel();

            $fakultas->update($this->request->getVar('id'), $simpanData);

            $msg = [
                'success' => 'Data telah berhasil diperbaharui.'
            ];

            echo json_encode($msg);
        }
    }

    public function toggleKuota()
    {
        if ($this->request->isAJAX()) {
            $simpanData = [
                'kuota_status' => $this->request->getVar('data'),
            ];

            $fakultas = new \App\Models\FakultasModel();

            $fakultas->update($this->request->getVar('id'), $simpanData);

            $msg = [
                'success' => 'Data telah berhasil diperbaharui.'
            ];

            echo json_encode($msg);
        }
    }

    public function deleteFakultas()
    {
        if ($this->request->isAJAX()) {

            $fakultas = new \App\Models\FakultasModel();

            $fakultas->delete($this->request->getVar('id'));

            $msg = [
                'success' => 'Data telah berhasil dihapus.'
            ];

            echo json_encode($msg);
        }
    }

    public function addFadep()
    {
        if ($this->request->isAJAX()) {
            $simpanData = [
                'id_fakultas' => $this->request->getVar('id_fakultas'),
                'id_departement' => $this->request->getVar('id_departement'),
            ];

            $fadep = new \App\Models\FadepModel();

            $fadep->insert($simpanData);

            $msg = [
                'success' => 'Departement telah ditambahkan.'
            ];

            echo json_encode($msg);
        }
    }

    public function deleteFadep()
    {
        if ($this->request->isAJAX()) {
            $deleteData = [
                'id_fakultas' => $this->request->getVar('id_fakultas'),
                'id_departement' => $this->request->getVar('id_departement'),
            ];

            $fadep = new \App\Models\FadepModel();

            $fadep->where($deleteData)->delete();

            $msg = [
                'success' => 'Departement telah dihilangkan.'
            ];

            echo json_encode($msg);
        }
    }

    public function acceptUser()
    {
        if ($this->request->isAJAX()) {
            $simpanData = [
                'active' => 1,
                'fullname' => 'Update'
            ];

            $active = new \Myth\Auth\Models\UserModel();

            $active->update($this->request->getVar('id'), $simpanData);

            $msg = [
                'success' => 'User telah diberi akses.'
            ];

            echo json_encode($msg);
        }
    }

    public function deleteUser()
    {
        if ($this->request->isAJAX()) {
            $user = new \Myth\Auth\Models\UserModel();

            $user->delete($this->request->getVar('id'));

            $msg = [
                'success' => 'User telah dihapus.'
            ];

            echo json_encode($msg);
        }
    }


    public function simpanDepartement()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'departement' => [
                    'label' => 'Departement',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'desc' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'departement' => $validation->getError('departement'),
                        'desc' => $validation->getError('desc'),
                    ]
                ];
            } else {
                $simpanData = [
                    'departement' => $this->request->getVar('departement'),
                    'desc' => $this->request->getVar('desc'),
                ];

                $departement = new \App\Models\DepartementModel();

                $departement->insert($simpanData);

                $msg = [
                    'success' => 'Data telah berhasil tersimpan.'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function updateDepartement()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'departement' => [
                    'label' => 'Departement',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'desc' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'departement' => $validation->getError('departement'),
                        'desc' => $validation->getError('desc'),
                    ]
                ];
            } else {
                $simpanData = [
                    'departement' => $this->request->getVar('departement'),



                    'desc' => $this->request->getVar('desc'),
                ];

                $departement = new \App\Models\DepartementModel();

                $departement->update($this->request->getVar('id'), $simpanData);

                $msg = [
                    'success' => 'Data telah berhasil diperbaharui.'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function deleteDepartement()
    {
        if ($this->request->isAJAX()) {

            $departement = new \App\Models\DepartementModel();

            $departement->delete($this->request->getVar('id'));

            $msg = [
                'success' => 'Data telah berhasil dihapus.'
            ];

            echo json_encode($msg);
        }
    }

    public function deleteExchange()
    {
        if ($this->request->isAJAX()) {

            $exchange = new \App\Models\StudentAppliedModel();

            $exchange->delete($this->request->getVar('id'));

            $msg = [
                'success' => 'Data telah berhasil dihapus.'
            ];

            echo json_encode($msg);
        }
    }

    public function updateFormat()
    {
        if ($this->request->isAJAX()) {
            $simpanData = [
                'value' => $this->request->getVar('file_format'),
            ];

            $setting = new \App\Models\SettingsModel();

            $setting->update(['key' => 'file_format'], $simpanData);

            $msg = [
                'success' => 'Data telah berhasil tersimpan.'
            ];

            echo json_encode($msg);
        }
    }

    public function updateSetting()
    {
        if ($this->request->isAJAX()) {
            $setting = new \App\Models\SettingsModel();

            $setting->set('value', $this->request->getVar('value'))->where('key', 'contact_us')->update();

            $msg = [
                'success' => 'Data telah berhasil tersimpan.'
            ];

            echo json_encode($msg);
        }
    }

    public function dataStatus()
    {
        if ($this->request->isAJAX()) {
            $status = new \App\Models\StatusModel();

            echo json_encode($status->findAll());
        }
    }

    public function addStatus()
    {
        if ($this->request->isAJAX()) {
            $status = new \App\Models\StatusModel();

            $data = [
                'status' => $this->request->getVar('status'),
                'desc' => $this->request->getVar('desc'),
            ];

            $status->insert($data);
        }
    }

    public function updateStatus()
    {
        if ($this->request->isAJAX()) {
            $status = new \App\Models\StatusModel();
            $data = [
                $this->request->getVar('table_column') => $this->request->getVar('value'),
            ];

            $status->update($this->request->getVar('id'), $data);
        }
    }

    public function deleteStatus()
    {
        if ($this->request->isAJAX()) {
            $status = new \App\Models\StatusModel();

            $status->delete($this->request->getVar('id'));
        }
    }

    public function updateExchangeStatus()
    {
        if ($this->request->isAJAX()) {
            $status = new \App\Models\StudentAppliedModel();
            $data = [
                'status' => $this->request->getVar('value'),
            ];

            $status->update($this->request->getVar('id'), $data);

            $msg = [
                'success' => 'Status telah diperbaharui.'
            ];

            echo json_encode($msg);
        }
    }


    public function updateLoa()
    {
        if ($this->request->isAJAX()) {
            $dataBerkas = $this->request->getFile("loa");
            $ext = $dataBerkas->getClientExtension();
            $fileName = "LOA-" . date('YmdHis') . "." . $ext;

            $simpanData = [
                'loa' => $fileName,
            ];

            $student = new \App\Models\StudentAppliedModel();

            $dataBerkas->move(ROOTPATH . 'public/LOA/', $fileName);

            $student->update($this->request->getVar('id'), $simpanData);

            $msg = [
                'success' => 'LOA telah diupload.'
            ];

            echo json_encode($msg);
        }
    }

    public function updateVisa()
    {
        if ($this->request->isAJAX()) {
            $dataBerkas = $this->request->getFile("visa");
            $ext = $dataBerkas->getClientExtension();
            $fileName = "VISA-" . date('YmdHis') . "." . $ext;

            $simpanData = [
                'visa' => $fileName,
            ];

            $student = new \App\Models\StudentAppliedModel();

            $dataBerkas->move(ROOTPATH . 'public/VISA/', $fileName);

            $student->update($this->request->getVar('id'), $simpanData);

            $msg = [
                'success' => 'Visa telah diupload.'
            ];

            echo json_encode($msg);
        }
    }

    public function updateKitas()
    {
        if ($this->request->isAJAX()) {
            $dataBerkas = $this->request->getFile("kitas");
            $ext = $dataBerkas->getClientExtension();
            $fileName = "KITAS-" . date('YmdHis') . "." . $ext;

            $simpanData = [
                'kitas' => $fileName,
            ];

            $student = new \App\Models\StudentAppliedModel();

            $dataBerkas->move(ROOTPATH . 'public/KITAS/', $fileName);

            $student->update($this->request->getVar('id'), $simpanData);

            $msg = [
                'success' => 'Kitas telah diupload.'
            ];

            echo json_encode($msg);
        }
    }

    public function modalUser()
    {
        if ($this->request->isAJAX()) {
            $user = new \Myth\Auth\Models\UserModel();

            $data = [
                'user' => $user->find($this->request->getVar('id_user')),
                'email' => $user->find($this->request->getVar('email')),
            ];

            $message = [
                "data" => view("admin/modalVerifikasi", $data)
            ];
            echo json_encode($message);
        }
    }

    public function updateUser()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'mhs' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'mhs' => $validation->getError('mhs'),
                    ]
                ];
            } else {
                $config['mailType'] = 'html';
                $config['protocol'] = 'smtp';
                $config['SMTPHost'] = 'kuiunj.fitys.art';
                $config['SMTPUser'] = 'info.kui@kuiunj.fitys.art';
                $config['SMTPPass'] = 'KUIUNJ2020';
                $config['SMTPPort'] = 465;
                $config['SMTPTimeout'] = 60;
                $config['SMTPCrypto'] = 'ssl';

                $email = \Config\Services::email();
                $email->initialize($config);

                $email->setFrom('info.kui@kuiunj.fitys.art', 'Office of International Affairs');
                $email->setTo($this->request->getVar('email'));

                $email->setSubject('Student Exchange Verification');
                $email->setMessage('Congratulations, your student exchange program account is verified');

                if (!$email->send()) {
                    $msg = [
                        'error' => [
                            'email' => $email->printDebugger(['headers'])
                        ]
                    ];
                } else {
                    $status = new \Myth\Auth\Models\UserModel();
                    $data = [
                        'mhs' => $this->request->getVar('mhs'),
                        'active' => 1,
                    ];

                    $status->update($this->request->getVar('id_user'), $data);

                    $msg = [
                        'success' => 'Status telah diperbaharui.'
                    ];
                }
            }

            echo json_encode($msg);
        }
    }

    public function sendEmailNotVerified()
    {
        $config['mailType'] = 'html';
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'kuiunj.fitys.art';
        $config['SMTPUser'] = 'info.kui@kuiunj.fitys.art';
        $config['SMTPPass'] = 'KUIUNJ2020';
        $config['SMTPPort'] = 465;
        $config['SMTPTimeout'] = 60;
        $config['SMTPCrypto'] = 'ssl';

        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom('info.kui@kuiunj.fitys.art', 'Office of International Affairs');
        $email->setTo($this->request->getVar('email'));
        $email->setSubject('Student Exchange Verification');
        $email->setMessage('Sorry, your student exchange program account is not verified');

        if (!$email->send()) {
            $msg = [
                'error' => [
                    'email' => 'Gagal mengirim email.'
                ]
            ];
        } else {
            $status = new \Myth\Auth\Models\UserModel();
            $data = [
                'active' => 2,
            ];

            $status->update($this->request->getVar('id'), $data);

            $msg = [
                'success' => 'Status telah diperbaharui.'
            ];
        }
        echo json_encode($msg);
    }

    public function getUsersExchange()
    {
        $request = Services::request();
        $datatable = new \App\Models\UsersModel($request);
        $exchanges = new \App\Models\StudentAppliedModel();
        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            $exchange = $exchanges->getStudentApplied();

            foreach ($lists as $list) {
                $progress = '<span class="badge badge-pill badge-secondary">-</span>';
                foreach ($exchange as $value) {
                    if ($value['id_user'] == $list->id) {
                        $label = 'warning';
                        if ($value['id_status'] == 2) {
                            $label = 'danger';
                        } else {
                            $label = 'success';
                        }
                        $progress = '<span class="badge badge-pill badge-' . $label . '">' . $value['status'] . '</span>';
                    }
                }
                $no++;
                $row = [];
                $row[] = $list->fullname;
                $row[] = $list->prodi;
                $row[] = '<span class="badge badge-pill badge-' . ($list->active == 1 ? 'success' : 'danger') . '">' . ($list->active ? 'Active' : 'Inactive') . '</span>';
                $row[] = $progress;
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
}
