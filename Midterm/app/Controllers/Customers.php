<?php
namespace App\Controllers;
use App\Models\CustomerModel;

class Customers extends BaseController
{
    private array $rules = [
        'full_name' => 'required|min_length[2]|max_length[100]',
        'email'     => 'required|valid_email|max_length[100]',
        'phone'     => 'permit_empty|regex_match[/^[0-9+\- ]{7,20}$/]',
    ];

    private function formData(): array
    {
        return [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => trim((string) $this->request->getPost('phone')) ?: null,
        ];
    }

    private function findOrFail($id): array
    {
        $customer = (new CustomerModel())->find($id);
        if (! $customer)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Customer not found');
        }
        return $customer;
    }

    public function index()
    {
        return view('customers/index', [
            'title'     => 'Customers',
            'customers' => (new CustomerModel())->orderBy('full_name')->findAll(),
        ]);
    }

    public function new()
    {
        return view('customers/form', ['title' => 'Add Customer', 'customer' => null, 'action' => '/customers']);
    }

    public function create()
    {
        if (! $this->validate($this->rules))
        {
            return redirect()->back()->withInput();
        }
        (new CustomerModel())->insert($this->formData());
        session()->setFlashdata('message', 'Customer added.');
        return redirect()->to('/customers');
    }

    public function edit($id)
    {
        $customer = $this->findOrFail($id);
        return view('customers/form', ['title' => 'Edit Customer', 'customer' => $customer, 'action' => '/customers/edit/' . $customer['id']]);
    }

    public function update($id)
    {
        $this->findOrFail($id);
        if (! $this->validate($this->rules))
        {
            return redirect()->back()->withInput();
        }
        (new CustomerModel())->update($id, $this->formData());
        session()->setFlashdata('message', 'Customer updated.');
        return redirect()->to('/customers');
    }

    public function delete($id)
    {
        $this->findOrFail($id);
        (new CustomerModel())->delete($id);
        session()->setFlashdata('message', 'Customer deleted.');
        return redirect()->to('/customers');
    }
}