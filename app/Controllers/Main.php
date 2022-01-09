<?php

namespace App\Controllers;

// use App\Libraries\Mypdf;
use Dompdf\Dompdf;
use App\Models\M_admin;
use App\Models\M_member;
use App\Models\M_type_saving;
use App\Models\M_saving;
use App\Models\M_loan;
use App\Models\M_withdraw;
use App\Models\M_type_loan;
use Config\Services;


class Main extends BaseController
{
    public function __construct()
    {
        $this->M_admin = new M_admin();
        $request = Services::request();
        $this->M_member = new M_member($request);
        $this->M_type_saving = new M_type_saving();
        $this->M_saving = new M_saving();
        $this->M_loan = new M_loan();
        $this->M_withdraw = new M_withdraw();
        $this->M_type_loan = new M_type_loan();
        // $this->Mypdf = new Mypdf();
        helper('url', 'form', 'html');
    }
    public function index()
    {
        $data = [
            'title' => "Dashboard",
            'menu' => 'Dashboard'
        ];
        return view('dashboard', $data);
    }
    public function member($url = 'index', $id = null)
    {
        if ($url == 'create') {
            $data = [
                'title' => 'Add Member',
                'menu' => 'Member',
                'validation' => \Config\Services::validation()
            ];
            return view('member/add_member', $data);
        } elseif ($url == 'save') {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan nama anggota baru!',
                    ],

                ],
                'birth' => [
                    'rules' => 'valid_date[Y-m-d]|required',
                    'errors' => [
                        'required' => 'Kolom belum diisi.',
                        'valid_date' => 'Format tanggal tidak sesuai!'
                    ],

                ],
                'phone' => [
                    'rules'  => 'required|numeric',
                    'errors' => [
                        'required' => 'Silahkan masukkan nomor telp terlebih dahulu!',
                        'numeric' => 'Anda hanya dapat memasukkan angka!'
                    ],

                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan alamat anggota!',
                    ],

                ],
                'gender' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kelamin belum anda pilih.',
                    ],

                ],

            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/member/create')->withInput()->with('validation', $validation);
            }

            $str = "";
            $characters = array_merge(range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 8; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $data = [
                'id_member' => $str,
                'name' => $this->request->getPost('name'),
                'date_of_birth' => $this->request->getPost('birth'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
                'gender' => $this->request->getPost(('gender')),
                'created_at' => date('Y/m/d h:i:s'),

            ];
            $this->M_member->saveMember($data);
            if ($this->M_member->affectedRows() > 0) {
                session()->setFLashdata('success', 'Data telah disimpan.');
            }
            return redirect()->to('/main/member');
        } elseif ($url == 'edit' && $id != null) {
            $query_member = $this->M_member->getMember($id);
            $data = [
                'title' => 'Edit Member',
                'member' => $query_member,
                'menu' => 'Member',
                'validation' => \Config\Services::validation(),
            ];
            return view('member/edit_member', $data);
        } elseif ($url == 'update' && $id != null) {
            $query_member = $this->M_member->getMember($id);
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan nama anggota baru!',
                    ],

                ],
                'birth' => [
                    'rules' => 'valid_date[Y-m-d]|required',
                    'errors' => [
                        'required' => 'Kolom belum diisi.',
                        'valid_date' => 'Format tanggal tidak sesuai!'
                    ],

                ],
                'phone' => [
                    'rules'  => 'required|numeric',
                    'errors' => [
                        'required' => 'Silahkan masukkan nomor telp terlebih dahulu!',
                        'numeric' => 'Anda hanya dapat memasukkan angka!'
                    ],

                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan alamat anggota!',
                    ],

                ],
                'gender' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kelamin belum anda pilih.',
                    ],

                ],

            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/member/edit', $id)->withInput()->with('validation', $validation);
            }

            $data = array(
                'name' => $this->request->getPost('name'),
                'date_of_birth' => $this->request->getPost('birth'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
                'gender' => $this->request->getPost('gender'),
                'created_at' => $query_member["created_at"],
            );
            $this->M_member->updateMember($data, $this->request->getPost('id'));
            if ($this->M_member->affectedRows() > 0) {
                session()->setFLashdata('edited', 'Data telah diubah.');
            }
            return redirect()->to('/main/member');
        } elseif ($url == 'delete' && $id != null) {
            // $item = $this->M_member->getMember($id);

            $this->M_member->delete($id);
            if ($this->M_member->affectedRows() > 0) {
                session()->setFLashdata('deleted', 'Data telah dihapus!');
            }
            return redirect()->to('/main/member');
        }
        $data = [
            'title' => "Member",
            'menu' => 'Member',
            'member' => $this->M_member->getMember(),
        ];
        return view('member/member_view', $data);
    }
    public function memberlist()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        // $datatable = new Sales_Datatable($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_member->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];
                // $btnEdit = "<a href=\"/main/product/edit/".$list->id_product."\" class=\"btn btn-info btn-sm\">Edit</a>";
                $btnDetail = "<a href=\"/main/sales/detail/" . $list->id_member . "\" class=\"btn btn-light btn-sm\">Detail</a>";

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"#\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                    <a class=\"btn btn-info btn-sm\" href=\"/main/member/edit/" . $list->id_member . "\">
                        <i class=\"fas fa-pencil-alt\">
                        </i>
                        Edit
                    </a>
                    <a class=\"btn btn-danger btn-delete btn-sm\" href=\"/main/member/delete/" . $list->id_member . "\">
                        <i class=\"fas fa-trash\">
                        </i>
                        Delete
                    </a>
                </td>";


                //     $btnDelete = " <form action=\"/main/product/delete/".$list->id_product."\" class=\"d-inline\" method=\"post\">
                //     ". csrf_field()." 
                //     <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                //     <button type=\"submit\" class=\"btn btn-danger btn-sm rm\">Delete</button>
                // </form>";

                // $btnDelete = "<a href=\"#\" class=\"btn btn-danger btn-sm rm-product\" value=\"".$list->id_product."\">delete</a>";
                $row[] = $no;
                $row[] = $list->id_member;
                $row[] = $list->name;
                $row[] = $list->phone;
                $row[] = $list->gender;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_member->countAll(),
                'recordsFiltered' => $this->M_member->countFiltered(),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function typesaving($url = 'index', $id = null)
    {
        if ($url == 'create') {
            $data = [
                'title' => 'Tipe Simpanan',
                'menu' => 'Master',
                'validation' => \Config\Services::validation()
            ];
            return view('admin_root/type_saving/add_type', $data);
        } elseif ($url == 'save') {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan nama anggota baru!',
                    ],

                ],

                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan deskripsi tipe!',
                    ],

                ],


            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/typesaving/create')->withInput()->with('validation', $validation);
            }

            $str = "";
            $characters = array_merge(range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 5; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $data = [
                'id_saving_type' => $str,
                'name_type' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'created_at' => date('Y/m/d h:i:s'),

            ];
            $this->M_type_saving->saveType($data);
            if ($this->M_type_saving->affectedRows() > 0) {
                session()->setFLashdata('success', 'Data telah disimpan.');
            }
            return redirect()->to('/main/typesaving');
        } elseif ($url == 'edit' && $id != null) {
            $query_type = $this->M_type_saving->getType($id);
            $data = [
                'title' => 'Edit Tipe',
                'type' => $query_type,
                'menu' => 'Master',
                'validation' => \Config\Services::validation(),
            ];
            return view('admin_root/type_saving/edit_type', $data);
        } elseif ($url == 'update' && $id != null) {
            $query_type = $this->M_type_saving->getType($id);
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan nama anggota baru!',
                    ],

                ],

                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan deskipsi tipe!',
                    ],

                ],


            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/typesaving/edit', $id)->withInput()->with('validation', $validation);
            }

            $data = array(
                'name_type' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'created_at' => $query_type["created_at"],
            );
            $this->M_type_saving->updateType($data, $this->request->getPost('id'));
            if ($this->M_type_saving->affectedRows() > 0) {
                session()->setFLashdata('edited', 'Data telah diubah.');
            }
            return redirect()->to('/main/typesaving');
        } elseif ($url == 'delete' && $id != null) {
            $this->M_type_saving->delete($id);
            if ($this->M_type_saving->affectedRows() > 0) {
                session()->setFLashdata('deleted', 'Data telah dihapus!');
            }
            return redirect()->to('/main/typesaving');
        }
        $data = [
            'title' => "Type Saving",
            'menu' => 'Master',
            'type' => $this->M_type_saving->getType(),
        ];
        return view('admin_root/type_saving/type_view', $data);
    }
    public function typeloan($url = 'index', $id = null)
    {
        if ($url == 'create') {
            $data = [
                'title' => 'Tipe Simpanan',
                'menu' => 'Master',
                'validation' => \Config\Services::validation()
            ];
            return view('admin_root/type_loan/add_type', $data);
        } elseif ($url == 'save') {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan nama anggota baru!',
                    ],

                ],
                'loan_term' => [
                    'rules' => 'numeric|required',
                    'errors' => [
                        'numeric' => 'Hanya diperbolehkan input angka!',
                        'required' => 'Masukkan deskripsi tipe!',
                    ],

                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan deskripsi tipe!',
                    ],

                ],


            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/typeloan/create')->withInput()->with('validation', $validation);
            }

            $str = "";
            $characters = array_merge(range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 5; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $data = [
                'id_loan_type' => $str,
                'name_type' => $this->request->getPost('name'),
                'loan_term' => $this->request->getPost('loan_term'),
                'description' => $this->request->getPost('description'),
                'created_at' => date('Y/m/d h:i:s'),

            ];
            $this->M_type_loan->saveType($data);
            if ($this->M_type_loan->affectedRows() > 0) {
                session()->setFLashdata('success', 'Data telah disimpan.');
            }
            return redirect()->to('/main/typeloan');
        } elseif ($url == 'edit' && $id != null) {
            $query_type = $this->M_type_loan->getType($id);
            $data = [
                'title' => 'Edit Tipe',
                'menu' => 'Master',
                'type' => $query_type,
                'validation' => \Config\Services::validation(),
            ];
            return view('admin_root/type_loan/edit_type', $data);
        } elseif ($url == 'update' && $id != null) {
            $query_type = $this->M_type_loan->getType($id);
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan nama anggota baru!',
                    ],

                ],
                'loan_term' => [
                    'rules' => 'numeric|required',
                    'errors' => [
                        'numeric' => 'Hanya diperbolehkan input angka!',
                        'required' => 'Masukkan deskripsi tipe!',
                    ],

                ],
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan deskipsi tipe!',
                    ],

                ],


            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/typeloan/edit', $id)->withInput()->with('validation', $validation);
            }

            $data = array(
                'name_type' => $this->request->getPost('name'),
                'loan_term' => $this->request->getPost('loan_term'),
                'description' => $this->request->getPost('description'),
                'created_at' => $query_type["created_at"],
            );
            $this->M_type_loan->updateType($data, $this->request->getPost('id'));
            if ($this->M_type_loan->affectedRows() > 0) {
                session()->setFLashdata('edited', 'Data telah diubah.');
            }
            return redirect()->to('/main/typeloan');
        } elseif ($url == 'delete' && $id != null) {
            $this->M_type_loan->delete($id);
            if ($this->M_type_loan->affectedRows() > 0) {
                session()->setFLashdata('deleted', 'Data telah dihapus!');
            }
            return redirect()->to('/main/typeloan');
        }
        $data = [
            'title' => "Type loan",
            'menu' => 'Master',
            'type' => $this->M_type_loan->getType(),
        ];
        return view('admin_root/type_loan/type_view', $data);
    }
    public function saldo($id)
    {
        $withdraw = 0;
        $saving = $this->M_saving->getsaldo($id);
        $withdraw = $this->M_withdraw->allWithdraw($id);
        $data =  $saving['saldo'] - $withdraw['saldo'];
        return $data;
    }

    public function searchbyid($id)
    {
        $data = [
            'member' => $this->M_member->getMember($id),
            'saldo' => $this->saldo($id),
        ];
        echo json_encode($data);
    }

    public function addsaving($url = 'index',$id = null)
    {
        if ($url == 'save') {
            if (!$this->validate([
                'amount' => [
                    'rules'  => 'required|numeric',
                    'errors' => [
                        'required' => 'Silahkan masukkan nominal uang yang disimpan!',
                        'numeric' => 'Anda hanya dapat memasukkan angka!'
                    ],

                ],


            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/addsaving')->withInput()->with('validation', $validation);
            }
            $str = "";
            $characters = array_merge(range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 9; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $data = array(
                'id_saving' => $str,
                'id_member' => $this->request->getPost('id_member'),
                'id_type' => $this->request->getPost('id_saving_type'),
                'id_admin' => $this->request->getPost('id_admin'),
                'amount' => $this->request->getPost('amount'),
                'description' => $this->request->getPost('description'),
                'created_at' => date('Y/m/d h:i:s'),
            );
            $this->M_saving->saveDeposit($data);
            if ($this->M_saving->affectedRows() > 0) {
                session()->setFLashdata('success', 'Setor tunai berhasil ditambahkan.');
            }
            return redirect()->to('/main/addsaving/invoice/' . $str);
        }elseif ($url == 'invoice' && $id != null) {
            $query = $this->M_saving->getInvoice($id);
            $data = [
                'title' => "Stor Tunai",
                'menu' => 'Transaction',
                'invoice' => $this->M_saving->getInvoice($id),
                'saldo' => $this->saldo($query['id_member'])
            ];
            // dd($data);
            return view('transaction/invoice_save', $data);
        }
        
        $query_type = $this->M_type_saving->findAll();
        $type[null] = '- Pilih Jenis Simpanan -';
        foreach ($query_type as $typ) {
            $type[$typ['id_saving_type']] = $typ['name_type'];
        }
        $data = [
            'title' => "Setor Tunai",
            'menu' => 'Transaction',
            'validation' => \Config\Services::validation(),
            'type' => $type,
            'selected' => null,
        ];
        return view('transaction/add_saving', $data);
    }
    public function withdraw($url = 'index', $id = null)
    {
        if ($url == 'save') {
            if ($this->saldo($this->request->getPost('id_member')) - $this->request->getPost('amount') <= 0) {
                session()->setFLashdata('amount-error', 'Jumlah saldo tidak mencukupi!');
                $validation = \Config\Services::validation();
                return redirect()->to('/main/withdraw')->withInput()->with('validation', $validation);
            } else {
                if (!$this->validate([
                    'amount' => [
                        'rules'  => 'required|numeric',
                        'errors' => [
                            'required' => 'Silahkan masukkan nominal uang yang disimpan!',
                            'numeric' => 'Anda hanya dapat memasukkan angka!'
                        ],

                    ],
                ])) {
                    $validation = \Config\Services::validation();
                    return redirect()->to('/main/withdraw')->withInput()->with('validation', $validation);
                }
                $str = "";
                $characters = array_merge(range('0', '9'));
                $max = count($characters) - 1;
                for ($i = 0; $i < 9; $i++) {
                    $rand = mt_rand(0, $max);
                    $str .= $characters[$rand];
                }
                $data = array(
                    'id_withdraw' => $str,
                    'id_member' => $this->request->getPost('id_member'),
                    'id_admin' => $this->request->getPost('id_admin'),
                    'amount' => $this->request->getPost('amount'),
                    'description' => $this->request->getPost('description'),
                    'created_at' => date('Y/m/d h:i:s'),
                );
                $this->M_withdraw->saveWithdraw($data);
                if ($this->M_withdraw->affectedRows() > 0) {
                    session()->setFLashdata('success', 'Penarikkan saldo berhasil.');
                }
                return redirect()->to('/main/withdraw/invoice/' . $str);
            }
        } elseif ($url == 'invoice' && $id != null) {
            $query = $this->M_withdraw->getInvoice($id);
            $data = [
                'title' => "Penarikkan",
                'menu' => 'Transaction',
                'invoice' => $this->M_withdraw->getInvoice($id),
                'saldo' => $this->saldo($query['id_member'])
            ];
            // dd($data);
            return view('transaction/invoice_view', $data);
        }
        $data = [
            'title' => "Penarikkan",
            'menu' => 'Transaction',
            'validation' => \Config\Services::validation(),
        ];
        return view('transaction/withdraw_view', $data);
    }
    public function printWd($id)
    {
        $query = $this->M_withdraw->getInvoice($id);
        $data = [
            'invoice' => $this->M_withdraw->getInvoice($id),
            'saldo' => $this->saldo($query['id_member'])
            
        ];
        // $this->mypdf->genrate('transaction/print_withdraw',$this->M_withdraw->getInvoice($id));
        $dompdf = new Dompdf();
        $html = view('transaction/print_withdraw',$data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("sample.pdf",array("Attachment"=>0));
    }
    public function printSaving($id)
    {
        $query = $this->M_saving->getInvoice($id);
        $data = [
            'invoice' => $this->M_saving->getInvoice($id),
            'saldo' => $this->saldo($query['id_member'])
            
        ];
        $dompdf = new Dompdf();
        $html = view('transaction/print_saving',$data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("sample.pdf",array("Attachment"=>0));
    }

    public function loan($url = 'index', $id = null)
    {
        if ($url == 'save') {
            if (!$this->validate([
                'name' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Silahkan masukkan nama kebutuhan!',
                    ],
                    
                ],
                'amount' => [
                    'rules'  => 'required|numeric',
                    'errors' => [
                        'required' => 'Silahkan masukkan nominal uang yang disimpan!',
                        'numeric' => 'Anda hanya dapat memasukkan angka!'
                    ],
                    
                ],
                'installment_fee' => [
                    'rules'  => 'required|numeric',
                    'errors' => [
                        'required' => 'Silahkan besar bunga!',
                        'numeric' => 'Anda hanya dapat memasukkan angka!'
                    ],
                    
                ],


            ])) {
                // return ;
                $validation = \Config\Services::validation();
                return redirect()->to('/main/loan')->withInput()->with('validation', $validation);
            }
            $str = "";
            $characters = array_merge(range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 9; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $data = array(
                'id_loan' => $str,
                'id_member' => $this->request->getPost('id_member'),
                'id_type' => $this->request->getPost('id_loan_type'),
                'id_admin' => $this->request->getPost('id_admin'),
                'name' => $this->request->getPost('name'),
                'amount' => $this->request->getPost('amount'),
                'installment_fee' => $this->request->getPost('installment_fee'),
                'description' => $this->request->getPost('description'),
                'created_at' => date('Y/m/d h:i:s'),
                'updated_at' => date('Y/m/d h:i:s'),
            );
            $this->M_loan->saveLoan($data);
            if ($this->M_loan->affectedRows() > 0) {
                session()->setFLashdata('success', 'Setor tunai berhasil ditambahkan.');
            }
            return redirect()->to('/main/loan/invoice/' . $str);
        }elseif ($url == 'invoice' && $id != null) {
            $query = $this->M_loan->getInvoice($id);
            $data = [
                'title' => "Stor Tunai",
                'menu' => 'Transaction',
                'invoice' => $this->M_loan->getInvoice($id),
            ];
            // dd($data);
            return view('transaction/invoice_loan', $data);
        }
        
        $query_type = $this->M_type_loan->findAll();
        $type[null] = '- Pilih Jenis Simpanan -';
        foreach ($query_type as $typ) {
            $type[$typ['id_loan_type']] = $typ['name_type'];
        }
        $data = [
            'title' => "Pinjam Tunai",
            'menu' => 'Transaction',
            'validation' => \Config\Services::validation(),
            'type' => $type,
            'selected' => null,
        ];
        return view('transaction/loan_view', $data);
    }
    
}
