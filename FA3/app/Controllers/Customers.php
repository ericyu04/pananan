<?php
namespace App\Controllers;
use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();
        $dbCustomers = $model->findAll();

        $fCustomers = [];
        foreach ($dbCustomers as $customer) {
            $fCustomers[] = [
                'name' => $customer['full_name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
                'created_at' => $customer['created_at']
            ];
        }
        $options = [];
        foreach ($dbCustomers as $customer) {
            $options[] = [
                'id' => $customer['id'],
            ];
        }

        $data = ['customers' => $fCustomers, 'options' => $options];
        return view('customers', $data);
    }
    public function new()
    {
        $rules = [
            'full_name' => 'required|min_length[5]|max_length[100]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric|min_length[10]|max_length[15]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }
        return view('customers/newcust');
    }
    public function edit($id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if (!$customer) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found');
        }

        $data = ['customer' => $customer];
        return view('customers/editcust', $data);
    }
}