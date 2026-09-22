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

        $data = ['customers' => $fCustomers];
        return view('customers', $data);
    }
}