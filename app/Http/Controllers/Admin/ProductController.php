<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->hasRole('admin')) {
                $count = Product::count();
                $data = Product::latest()->paginate(10);

                return view('pages.dashboard.product.index')->with('data', $data)->with('count', $count);
            }
        } else {
            return view('errors.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'photos' => 'required',
            'photos.*' => 'mimes:png,jpg,jpeg',

            'name' => 'required|max:100',
            'price' => 'required',
            'desc' => 'required',
            'stock' => 'required',
            // 'pilihan' => 'required',
            // 'size' => 'required',
            'weight' => 'required',
        ]);

        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $image) {
                $name = time() . rand(1, 100) . ' - ' . $image->getClientOriginalName();
                $image->storeAs('products/images/', $name, 'public');
                $data[] = $name;
            }
        }

        $pilihanText[] = $request->pilihan;
        $sizeText[] = $request->size;

        $file = new Product();
        $file->images = json_encode($data);
        $file->title = $request->name;
        $file->price = $request->price;
        $file->desc = $request->desc;
        if (isset($request->unggulanCheck)) {
            $file->unggulan = $request->unggulanCheck;
        } else {
            $file->unggulan = null;
        }
        $file->stock = $request->stock;
        if ($pilihanText[0][0] != null) {
            $file->pilihan = json_encode($pilihanText);
        }
        if ($sizeText[0][0] != null) {
            $file->size = json_encode($sizeText);
        }
        $file->weight = $request->weight;

        if ($file->save()) {
            return redirect()->route('dashboard.product.index')->withToastSuccess('Product Created Successfully!');
        } else {
            return redirect()->back()->withToastError('Product failed Created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = Product::where('id_product', $id)->get();

        return view('pages.dashboard.product.edit')->with('editData', $editData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'photos.*' => 'mimes:png,jpg,jpeg',

            'name' => 'required|max:100',
            'price' => 'required',
            'desc' => 'required',
            'stock' => 'required',
            'size' => 'required',
            'weight' => 'required',
        ]);

        $editData = Product::where('id_product', $id)->get();

        if ($request->hasfile('photos')) {
            // Delete Old Photos
            foreach ($editData as $key) {
                $imageArr = json_decode($key->images, true);
                $files = array($imageArr);
                foreach ($files as $image) {
                    for ($i = 0; $i < count($image); $i++) {
                        File::delete(storage_path() . '/app/public/products/images/' . $image[$i]);
                    }
                }
            }

            // Add new images
            foreach ($request->photos as $image) {
                ///dd($image);
                $name = time() . rand(1, 100) . ' - ' . $image->getClientOriginalName();
                $image->storeAs('products/images/', $name, 'public');
                $dataNewImages[] = $name;
            }
        }

        $imageInput[] = $request->photos;
        $pilihanText[] = $request->pilihan;
        $sizeText[] = $request->size;

        $productUp = Product::find($id);

        if ($imageInput[0] != null) {
            $productUp->images = json_encode($dataNewImages);
        }
        $productUp->title = $request->name;
        $productUp->price = $request->price;
        $productUp->desc = $request->desc;
        if (isset($request->unggulanCheck)) {
            $productUp->unggulan = $request->unggulanCheck;
        } else {
            $productUp->unggulan = null;
        }
        $productUp->stock = $request->stock;
        if ($pilihanText[0][0] != null) {
            $productUp->pilihan = json_encode($pilihanText);
        }
        if ($sizeText[0][0] != null) {
            $productUp->size = json_encode($sizeText);
        }
        $productUp->weight = $request->weight;

        if ($productUp->save()) {
            return redirect()->route('dashboard.product.index')->withToastSuccess('Product Success edited!');
        } else {
            return redirect()->route('dashboard.product.index')->withToastError('Product failed edited!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = Product::findOrFail($id);

        foreach (json_decode($data->images, true) as $image => $value) {
            File::delete(storage_path() . '/app/public/products/images/' . $value);
        }

        if ($data->delete()) {
            return redirect()->route('dashboard.product.index')->withToastSuccess('Product deleted successfully');
        } else {
            return redirect()->route('dashboard.product.index')->withToastError('Product failed delete');
        }
    }
}
