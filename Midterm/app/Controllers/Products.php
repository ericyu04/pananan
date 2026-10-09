<?php
namespace App\Controllers;
use App\Models\ProductModel;

class Products extends BaseController
{
    private function rules(): array
    {
        return [
            'name'           => 'required|min_length[2]|max_length[100]',
            'price'          => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[99999999.99]',
            'stock_quantity' => 'required|is_natural',
            'image'          => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
        ];
    }

    private function findActiveOrFail($id): array
    {
        $product = (new ProductModel())->where('is_archived', 0)->find($id);
        if (! $product)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }
        return $product;
    }

    public function index()
    {
        $products = (new ProductModel())->where('is_archived', 0)->orderBy('name')->findAll();
        return view('products/index', ['title' => 'Products', 'products' => $products]);
    }

    public function new()
    {
        return view('products/form', ['title' => 'Add Product', 'product' => null, 'action' => '/products']);
    }

    public function create()
    {
        if (! $this->validate($this->rules()))
        {
            return redirect()->back()->withInput();
        }

        $data = [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];
        $image = save_image($this->request->getFile('image'), 'products', 400);
        if ($image !== null)
        {
            $data['image'] = $image;
        }

        (new ProductModel())->insert($data);
        session()->setFlashdata('message', 'Product added.');
        return redirect()->to('/products');
    }

    public function edit($id)
    {
        $product = $this->findActiveOrFail($id);
        return view('products/form', ['title' => 'Edit Product', 'product' => $product, 'action' => '/products/edit/' . $product['id']]);
    }

    public function update($id)
    {
        $product = $this->findActiveOrFail($id);

        if (! $this->validate($this->rules()))
        {
            return redirect()->back()->withInput();
        }

        $data = [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ];
        $image = save_image($this->request->getFile('image'), 'products', 400);
        if ($image !== null)
        {
            $data['image'] = $image;
            delete_image($product['image'], 'products');
        }

        (new ProductModel())->update($id, $data);
        session()->setFlashdata('message', 'Product updated.');
        return redirect()->to('/products');
    }

    public function delete($id)
    {
        $this->findActiveOrFail($id);
        (new ProductModel())->update($id, ['is_archived' => 1]);
        session()->setFlashdata('message', 'Product archived.');
        return redirect()->to('/products');
    }
}