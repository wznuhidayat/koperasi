<?php

namespace App\Controllers;

// use App\Libraries\Mypdf;
use CodeIgniter\I18n\Time;
use \DateTime;
use Dompdf\Dompdf;
use App\Models\M_admin;
use App\Models\M_member;
use App\Models\M_type_saving;
use App\Models\M_saving;
use App\Models\M_loan;
use App\Models\M_withdraw;
use App\Models\M_installment;
use App\Models\M_installment_dt;
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
        $this->M_saving = new M_saving($request);
        $this->M_loan = new M_loan($request);
        $this->M_withdraw = new M_withdraw($request);
        $this->M_installment = new M_installment($request);
        $this->M_installment_dt = new M_installment_dt($request);
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
        } elseif ($url == 'profile' && $id != null){
            $data = [
                'title' => "Member",
                'menu' => 'Member',
                'member' => $this->M_member->getMember($id),
                'saldo' => $this->saldo($id),
                
            ];
            return view('member/profile_view', $data);
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
        $segment = 'member';
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_member->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/member/profile/" . $list->id_member . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                    <a class=\"btn btn-info btn-sm\" href=\"/main/member/edit/" . $list->id_member . "\">
                        <i class=\"fas fa-pencil-alt\">
                        </i>
                        Edit
                    </a>
                    <a class=\"btn btn-danger btn-sm\" href=\"#\" onclick=\"rm_member(".$list->id_member.")\">
                        <i class=\"fas fa-trash\">
                        
                        </i>
                        Delete
                    </a>
                    
                </td>";

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
    //detail member datatable
    public function savingid(){
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        // $datatable = new Sales_Datatable($request);
        $id_member = $this->request->getPost('id_member');
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_saving->getDatatables($id_member);
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/addsaving/invoice/" . $list->id_saving . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                    
                   
                    
                </td>";

                $row[] = $no;
                $row[] = $list->id_saving;
                $row[] = $list->member_name;
                $row[] = $list->name_type;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->saving_created)) . "</td>";
                $row[] = $created;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_saving->countAll($id_member),
                'recordsFiltered' => $this->M_saving->countFiltered($id_member),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function withdrawid()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        // $datatable = new Sales_Datatable($request);
        $id_member = $this->request->getPost('id_member');
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_withdraw->getDatatables($id_member);
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/withdraw/invoice/" . $list->id_withdraw . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                </td>";

               
                $row[] = $no;
                $row[] = $list->id_withdraw;
                $row[] = $list->member_name;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->wd_created)) . "</td>";
                $row[] = $created;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_withdraw->countAll($id_member),
                'recordsFiltered' => $this->M_withdraw->countFiltered($id_member),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function loanlistid()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        $id_member = $this->request->getPost('id_member');
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_loan->getDatatables($id_member);
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/loan/invoice/" . $list->id_loan . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                </td>";

               
                $row[] = $no;
                $row[] = $list->id_loan;
                $row[] = $list->member_name;
                $row[] = $list->loan_term;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->created_at)) . "</td>";
                $row[] = $created;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_loan->countAll($id_member),
                'recordsFiltered' => $this->M_loan->countFiltered($id_member),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function installmentid()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        $id_member = $this->request->getPost('id_member');
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_installment_dt->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/loan/invoice/" . $list->id_installment . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                </td>";

               
                $row[] = $no;
                $row[] = $list->id_installment;
                $row[] = $list->member_name;
                $row[] = $list->period;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->paid_at)) . "</td>";
                $row[] = $created;
                $row[] = $list->admin_name;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_installment_dt->countAll(),
                'recordsFiltered' => $this->M_installment_dt->countFiltered(),
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

    public function addsaving($url = 'index', $id = null)
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
        } elseif ($url == 'invoice' && $id != null) {
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
        $html = view('transaction/print_withdraw', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("sample.pdf", array("Attachment" => 0));
    }
    public function printSaving($id)
    {
        $query = $this->M_saving->getInvoice($id);
        $data = [
            'invoice' => $this->M_saving->getInvoice($id),
            'saldo' => $this->saldo($query['id_member'])

        ];
        $dompdf = new Dompdf();
        $html = view('transaction/print_saving', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("sample.pdf", array("Attachment" => 0));
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
            $query_installment = $this->M_installment->getInstallment($this->request->getPost('id_member'));
            foreach($query_installment as $installment){
                if($installment['status'] == 'unpaid'){
                    session()->setFLashdata('amount-error', 'Gagal, karena pinjaman sebelumnya masih belum lunas');
                    $validation = \Config\Services::validation();
                    return redirect()->to('/main/loan')->withInput()->with('validation', $validation);
                }
            }

            $str = "";
            $characters = array_merge(range('0', '9'));
            $max = count($characters) - 1;
            for ($i = 0; $i < 5; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            $query_type = $this->M_type_loan->getType($this->request->getPost('id_loan_type'));
            $p = $this->request->getPost('amount') / $query_type['loan_term'];
            $b = ($this->request->getPost('amount') * $this->request->getPost('installment_fee'))  / 100 / $query_type['loan_term'];
            $i = date("Y-m-d");
            $data = array(
                'id_loan' => $str,
                'id_member' => $this->request->getPost('id_member'),
                'id_type' => $this->request->getPost('id_loan_type'),
                'id_admin' => $this->request->getPost('id_admin'),
                'name' => $this->request->getPost('name'),
                'amount' => $this->request->getPost('amount'),
                'installment_fee' => $this->request->getPost('installment_fee'),
                'installment_amount' => $p + $b,
                'created_at' => date('Y/m/d h:i:s'),
                'updated_at' => date('Y/m/d h:i:s'),
            );

            $this->M_loan->saveLoan($data);

            for ($x = 0; $x < $query_type['loan_term']; $x++) {

                $d = new DateTime($i);
                // $id = $str.$d->format('Y') . $d->format('m');
                // echo $str.$d->format('Y') . $d->format('m');
                // echo '</br>';

                $d->modify('first day of next month');
                $data = array(
                    'id_installment' => $str . $d->format('y') . $d->format('m'),
                    'id_loan' => $str,
                    'period' => $d->format('Y') . $d->format('m'),
                    'amount' => $p + $b,
                    'status' => 'unpaid',
                    'paid_at' => null,
                    'id_admin' => null,
                );
                $this->M_installment->saveInstallment($data);
                $i = $d->format('Y') . '-' . $d->format('m') . '-' . $d->format('d');
            }
            if ($this->M_loan->affectedRows() > 0) {
                session()->setFLashdata('success', 'Setor tunai berhasil ditambahkan.');
            }
            return redirect()->to('/main/loan/invoice/' . $str);
        } elseif ($url == 'invoice' && $id != null) {
            $query = $this->M_loan->getInvoice($id);
            $data = [
                'title' => "Pinjam Tunai",
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
    public function printLoan($id)
    {
        $data = [
            'invoice' => $this->M_loan->getInvoice($id),
        ];
        $dompdf = new Dompdf();
        $html = view('transaction/print_loan', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("sample.pdf", array("Attachment" => 0));
    }
    public function InstallmentPay()
    {
        $data = [
            'title' => "Bayar Angsuran",
            'menu' => 'Transaction',
        ];
        return view('transaction/installment_pay/pay_view', $data);
    }
    public function invoiceInstallment()
    {
        $invoice = array();
        foreach ($this->request->getPost('id') as $pay) {
            $inv = $this->M_installment->getInvoiceInstallment($pay);
            if ($inv['status'] == 'unpaid') {
                $data = [
                    'id_installment' => intval($pay),
                    'status' => 'paid',
                    'paid_at' => date('Y/m/d h:i:s'),
                ];
                $this->M_installment->pay($data, $pay);
                $invoice[] = $inv;
            }
        }
        if (count($invoice) == 0) {
            session()->setFLashdata('amount-error', ' Ansuran yang anda pilih telah lunas');
            return redirect()->to('/main/installmentpay')->withInput();
        } else {
            $data = [
                'title' => "Faktur Ansuran",
                'menu' => 'Transaction',
                'invoice' => $invoice,
                'member' => $this->M_member->getMember($invoice[0]['id_member']),
                'admin' => $this->M_admin->getAdmin($this->request->getPost('id_admin'))
            ];
            // dd($data);
            return view('transaction/installment_pay/invoice_installment', $data);
        }
    }
    public function searchInstallment()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        $id_member = $this->request->getPost('id_member');
        $lastLoan = $this->M_loan->getLastRecord($id_member);
        if ($request->getMethod(true) === 'POST') {
            if($lastLoan == null){
                $lists = $this->M_installment->getDatatables($id_member);
                $recordsTotal = $this->M_installment->countAll($id_member);
                $recordsFiltered = $this->M_installment->countFiltered($id_member);
            }else{
                $lists = $this->M_installment->getDatatables($id_member,$lastLoan['id_loan']);
                $recordsTotal = $this->M_installment->countAll($id_member,$lastLoan['id_loan']);
                $recordsFiltered = $this->M_installment->countFiltered($id_member,$lastLoan['id_loan']);
            }
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $row = [];
                // $check = "<td align='center'><input class='form-check-input' type='checkbox'></td>";

                // $row[] = $check;
                $row[] = $list->id_installment;
                $row[] = $list->id_installment;
                $row[] = $list->period;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                if ($list->status == 'paid') {
                    $sts = "<td ><span class='badge badge-success'>Lunas</span></td>";
                } else {
                    $sts = "<td><span class='badge badge-danger'>Belum dibayar</span></td>";
                }
                $row[] = $sts;
                if ($list->paid_at != null) {
                    $paided = "<td >" . tanggal(date($list->paid_at)) . "</td>";
                } else {
                    $paided = "<td > - </td>";
                }
                $row[] = $paided;
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function printinstallment()
    {
        $invoice = array();
        foreach ($this->request->getPost('id') as $pay) {
            $inv = $this->M_installment->getInvoiceInstallment($pay);
            $invoice[] = $inv;
        }
        $data = [
            'title' => "Faktur Ansuran",
            'menu' => 'Transaction',
            'invoice' => $invoice,
            'member' => $this->M_member->getMember($invoice[0]['id_member']),
            'admin' => $this->M_admin->getAdmin($this->request->getPost('id_admin'))
        ];
        $dompdf = new Dompdf();
        $html = view('transaction/installment_pay/print_installment', $data);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("sample.pdf", array("Attachment" => 0));
    }

    public function saving()
    {
        $data = [
            'title' => "Data Simpanan",
            'menu' => 'Master',
        ];
        return view('admin_root/saving/saving_view', $data);
    }
    public function savinglist(){
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        // $datatable = new Sales_Datatable($request);
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_saving->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];
                // $btnEdit = "<a href=\"/main/product/edit/".$list->id_product."\" class=\"btn btn-info btn-sm\">Edit</a>";
                $btnDetail = "<a href=\"/main/sales/detail/" . $list->id_saving . "\" class=\"btn btn-light btn-sm\">Detail</a>";

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/addsaving/invoice/" . $list->id_saving . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                    
                   
                    
                </td>";

                //     $btnDelete = " <form action=\"/main/product/delete/".$list->id_product."\" class=\"d-inline\" method=\"post\">
                //     ". csrf_field()." 
                //     <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                //     <button type=\"submit\" class=\"btn btn-danger btn-sm rm\">Delete</button>
                // </form>";

                // $btnDelete = "<a href=\"#\" class=\"btn btn-danger btn-sm rm-product\" value=\"".$list->id_product."\">delete</a>";
                $row[] = $no;
                $row[] = $list->id_saving;
                $row[] = $list->member_name;
                $row[] = $list->name_type;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->saving_created)) . "</td>";
                $row[] = $created;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_saving->countAll(),
                'recordsFiltered' => $this->M_saving->countFiltered(),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function wd()
    {
        $data = [
            'title' => "Data Penarikan",
            'menu' => 'Master',
        ];
        return view('admin_root/withdraw/wd_view', $data);
    }
    public function withdrawlist()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        // $datatable = new Sales_Datatable($request);
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_withdraw->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/withdraw/invoice/" . $list->id_withdraw . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                </td>";

               
                $row[] = $no;
                $row[] = $list->id_withdraw;
                $row[] = $list->member_name;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->wd_created)) . "</td>";
                $row[] = $created;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_withdraw->countAll(),
                'recordsFiltered' => $this->M_withdraw->countFiltered(),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }

    public function allLoan()
    {
        $data = [
            'title' => "Data Pinjaman",
            'menu' => 'Master',
        ];
        return view('admin_root/all_loan/loan_view', $data);
    }
    public function loanlist()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        // $datatable = new Sales_Datatable($request);
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_loan->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/loan/invoice/" . $list->id_loan . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                </td>";

               
                $row[] = $no;
                $row[] = $list->id_loan;
                $row[] = $list->member_name;
                $row[] = $list->loan_term;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->created_at)) . "</td>";
                $row[] = $created;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_loan->countAll(),
                'recordsFiltered' => $this->M_loan->countFiltered(),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function installment()
    {
        $data = [
            'title' => "Data Ansuran",
            'menu' => 'Master',
        ];
        return view('admin_root/installment/installment_view', $data);
    }
    public function installmentlist()
    {
        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $request = Services::request();
        // $datatable = new Sales_Datatable($request);
        if ($request->getMethod(true) === 'POST') {
            $lists = $this->M_installment_dt->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {

                $no++;
                $row = [];

                $btn = " <td class=\"project-actions\">
                    <a class=\"btn btn-primary btn-sm\" href=\"/main/loan/invoice/" . $list->id_installment . "\">
                        <i class=\"fas fa-folder\">
                        </i>
                        View
                    </a>
                </td>";

               
                $row[] = $no;
                $row[] = $list->id_installment;
                $row[] = $list->member_name;
                $row[] = $list->period;
                $amt = " <td>Rp. " . number_format($list->amount, 0, ',', '.') . "</td>";
                $row[] = $amt;
                $created = "<td >" . tanggal(date($list->paid_at)) . "</td>";
                $row[] = $created;
                $row[] = $list->admin_name;
                $row[] = $btn;
                $row[] = '';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $this->M_installment_dt->countAll(),
                'recordsFiltered' => $this->M_installment_dt->countFiltered(),
                'data' => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
    public function profile($url = 'index', $id = null)
    {
        if ($url == 'update' && $id != null) {
            $query_admin = $this->M_admin->getadmin($this->request->getPost('id'));
          
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Masukkan nama anggota baru!',
                    ],

                ], 
                'phone' => [
                    'rules'  => 'required|numeric',
                    'errors' => [
                        'required' => 'Silahkan masukkan nomor telp terlebih dahulu!',
                        'numeric' => 'Anda hanya dapat memasukkan angka!'
                    ],

                ],
                'passconf' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'Password yang anda masukkan tidak sesuai',
                    ],

                ],
                'gender' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kelamin belum anda pilih.',
                    ],

                ],
                'image' => [
                    'rules' => 'max_size[image,2048]|mime_in[image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'mime_in' => 'Format gambar tidak didukung'
                    ]
                ]

            ])) {
                // return ;
                $validation = \Config\Services::validation();
                session()->setFLashdata('amount-error', 'Data gagal telah diubah.');
                return redirect()->to('/main/profile/index/'. $id)->withInput()->with('validation', $validation);
            }
            if (empty($this->request->getPost('password'))) {
                $pass = $query_admin['password'];
            } else {
                $pass = md5($this->request->getPost('password'));
            }
            $fileImg = $this->request->getFile('image');
            if ($fileImg->getError() == 4) {
                $nameImg = $this->request->getVar('oldimg');
            } else {
                $nameImg = $fileImg->getRandomName();
                $fileImg->move('img/admin', $nameImg);
                if ($this->request->getVar('oldimg') != 'default.png') {
                    unlink('img/admin/' . $this->request->getVar('oldimg'));
                }
            }

            $data = array(
                'name' => $this->request->getPost('name'),
                'phone' => $this->request->getPost('phone'),
                'gender' => $this->request->getPost('gender'),
                'password' => $pass,
                'img' => $nameImg,
            );
            $this->M_admin->updateAdmin($data, $this->request->getPost('id'));
            if ($this->M_admin->affectedRows() > 0) {
                session()->setFLashdata('success', 'Data berhasil telah diubah.');
            }
            return redirect()->to('/main/profile/index/'.$this->request->getPost('id'));
        }
        $data = [
            'title' => "Profile",
            'menu' => 'User',
            'validation' => \Config\Services::validation(),
            'admin' => $this->M_admin->getAdmin($id)
        ];
        // dd($data);
        return view('setting/profile/profile_view', $data);
    }
   
}   
