<?php
namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    public function new()
    {
        return view('sales/new', [
            'title'     => 'Record Sale',
            'products'  => (new ProductModel())->where('is_archived', 0)->orderBy('name')->findAll(),
            'customers' => (new CustomerModel())->orderBy('full_name')->findAll(),
        ]);
    }

    public function create()
    {
        $rules = [
            'product_id'  => 'required|is_natural_no_zero|is_not_unique[products.id]',
            'customer_id' => 'permit_empty|is_natural_no_zero|is_not_unique[customers.id]',
            'quantity'    => 'required|is_natural_no_zero',
        ];
        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput();
        }

        $productId  = (int) $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id') ?: null;
        $quantity   = (int) $this->request->getPost('quantity');

        $db    = db_connect();
        $error = null;

        $db->transStart();

        $product = $db->query(
            'SELECT * FROM products WHERE id = ? AND is_archived = 0 FOR UPDATE',
            [$productId]
        )->getRowArray();

        if (! $product)
        {
            $error = 'That product is no longer available.';
        }
        elseif ($quantity > (int) $product['stock_quantity'])
        {
            $error = "Not enough stock for {$product['name']}. Requested: {$quantity}, available: {$product['stock_quantity']}.";
        }
        else
        {
            $db->query(
                'UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ?',
                [$quantity, $productId]
            );
            (new SaleModel())->insert([
                'product_id'  => $productId,
                'customer_id' => $customerId,
                'sold_by'     => session()->get('user_id'),
                'quantity'    => $quantity,
                'total_price' => round((float) $product['price'] * $quantity, 2),
            ]);
        }

        $db->transComplete();

        if ($error !== null)
        {
            session()->setFlashdata('error', $error);
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('message', 'Sale recorded.');
        return redirect()->to('/sales');
    }

    public function index()
    {
        return view('sales/index', ['title' => 'Sales History', 'sales' => (new SaleModel())->history()]);
    }
}