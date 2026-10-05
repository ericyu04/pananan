<?php
namespace App\Controllers;
use App\Models\CustomerModel;

class Customers extends BaseController
{
    private array $rules = [
        'full_name' => 'required|min_length[5]|max_length[100]',
        'email' => 'required|valid_email',
        'phone' => 'required|numeric|min_length[10]|max_length[15]'
    ];

    public function index()
    {
        $model = new CustomerModel();
        return view('customers', ['customers' => $model->findAll()]);
    }

    public function new()
    {
        return view('customers/newcust');
    }

    public function create()
    {
        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        $model = new CustomerModel();
        $model->insert([
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone')
        ]);

        return redirect()->to('/customers');
    }

    public function edit($id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if (!$customer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found');
        }

        return view('customers/editcust', ['customer' => $customer]);
    }

    public function update($id)
    {
        $model = new CustomerModel();
        
        if (! $model->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found');
        }
        if (! $this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        $model->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone')
        ]);

        return redirect()->to('/customers');
    }


    // public function new()
    // {
    //     $rules = [
    //         'full_name' => 'required|min_length[5]|max_length[100]',
    //         'email' => 'required|valid_email',
    //         'phone' => 'required|numeric|min_length[10]|max_length[15]'
    //     ];
    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput();
    //     }
    //     return view('customers/newcust');
    // }
    // public function edit($id)
    // {
    //     $model = new CustomerModel();
    //     $customer = $model->find($id);

    //     if (!$customer) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found');
    //     }

    //     $data = ['customer' => $customer];
    //     return view('customers/editcust', $data);
    // }
}