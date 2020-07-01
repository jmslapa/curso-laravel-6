<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{   
    /**
     * Specific model repository referenced by this controller
     *
     * @var App\Model\Product
     */
    protected $repository;

    /**
     * Builds the controller with a Product model dependency
     */
    public function __construct(Product $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = $this->repository->paginate(20);

      return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Products\StoreUpdateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {   
        $data = $request->except('_token', '_method');
        $data['price'] = str_replace(',', '.', $data['price']);

        if($request->hasFile('image') && $request->image->isValid()) {           
            $imagePath = $request->image->store('images/products', 'public');
            $data['image'] = $imagePath;
        }

        $product = $this->repository->create($data);
        return redirect()->route('products.show', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $this->repository->timestamps = false;
        $product = $this->repository->find($id);
        if(is_null($product)) {
            return redirect()->back();
        }
        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->repository->find($id);
        if(is_null($product)) {
            return redirect()->back();
        }        
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Products\StoreUpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {   
        $product = $this->repository->find($id);
        if(is_null($product)) {
            return redirect()->back();
        }
        $data = $request->except('_token', '_method');
        $data['price'] = str_replace(',', '.', $data['price']);

        if($request->hasFile('image') && $request->image->isValid()) {
            if(!is_null($product->image) && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }            
            $imagePath = $request->image->store('images/products', 'public');
            $data['image'] = $imagePath;
        }else {
            if($request->has('removeImage') && $request->removeImage == 'on') {
                if(!is_null($product->image) && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                    $data['image'] = null;
                }
            }
        }

        $product->update($data);
        return redirect()->route('products.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->find($id);
        if(is_null($product)) {
            return redirect()->back();
        }
        if(!is_null($product->image) && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $this->repository->destroy($id);
        return redirect()->route('products.index');
    }

    
    public function search(Request $request) {   
        $filters = $request->except('_token');
        $products = $this->repository->search($request->filter);
        return view('admin.pages.products.index', compact(['products', 'filters']));
    }        
}