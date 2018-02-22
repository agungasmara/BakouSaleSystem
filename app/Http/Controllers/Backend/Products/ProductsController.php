<?php

namespace App\Http\Controllers\Backend\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Product\ProductModel;
use App\Http\Models\BackEnd\Product\ProductDescription;
use App\Http\Models\BackEnd\Product\ProductAttribute;
use App\Http\Models\BackEnd\Product\ProductToCategory;
use App\Http\Models\BackEnd\Product\ProductOption;
use App\Http\Models\BackEnd\Product\ProductOptionValue;
use App\Http\Models\BackEnd\Product\ProductDiscount;
use App\Http\Models\BackEnd\Product\ProductSpecial;
use App\Http\Models\BackEnd\Product\ProductImage;
// use App\Http\Controllers\Backend\commons\ImageMaker;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Backend\commons\DataAction;
class ProductsController extends Controller
{
    public function __construct()
    {
        
    }
    public function index()
    {

        $Products = ProductModel::select('product_id','model','image','price','quantity','sort_order','status')->OrderBy('product_id','desc')->get();
        foreach ($Products as $Product) {
            $Product->name=$Product->Description()->value('name');
            $Product->id=$Product->product_id;
        }
        // dd($Products);
        return $Products;
    }
   
    public function store(Request $request)
    {
        // insert product
        $fill = (new ProductModel)->getFillable();
        $data=array_only($request['data'],$fill);
        $dir='/images/product';
        $image=$request['data']['image'];
        $data['image']=$this->ImageMaker($dir,$image);
        $data['date_added']=date('Y-m-d h:i:s');
        $data['date_modified']=date('Y-m-d h:i:s');
        $product_id=ProductModel::insertGetId($data);


        if (isset($request['links']['category_id']) && $request['links']['category_id']) {
            # code...
            foreach ($request['links']['category_id'] as $item) {
                $p2c['product_id']=$product_id;
                $p2c['category_id']=$item;
                ProductToCategory::insert($p2c);
            }
        }


        if (isset($request['links']['store_id']) && $request['links']['store_id']) {
            # code...
            foreach ($request['links']['store_id'] as $item) {
                $p2s['product_id']=$product_id;
                $p2s['store_id']=$item;
                ProductToCategory::insert($p2s);
            }
        }

        $fill=(new ProductImage)->getFillable();
        foreach ($request['gallery'] as $item) {
            $item['image']=$this->ImageMaker($dir,$item['image']);
            $data=array_only($item,$fill);
            $data['product_id']=$product_id;
            ProductImage::insert($data);
        }

        $fill=(new ProductAttribute)->getFillable();
        foreach ($request['attributes'] as $item) {
            $data=array_only($item,$fill);
            $data['product_id']=$product_id;
            ProductAttribute::insert($data);
        }

        $fill=(new ProductOption)->getFillable();
        foreach ($request['option'] as $item) {
            $data=array_only($item,$fill);
            $data['product_id']=$product_id;
            $product_option_id=ProductOption::insertGetId($data);
            $fill=(new ProductOptionValue)->getFillable();
            if ($item['checkItem']) {
                foreach ($item['checkItem'] as $value) {
                    $data=array_only($value,$fill);
                    $data['product_option_id']=$product_option_id;
                    $data['product_id']=$product_id;
                    $data['option_id']=$item['option_id'];
                    ProductOptionValue::insert($data);
                }
            }
        }

        $fill=(new ProductDiscount)->getFillable();
        foreach ($request['discount'] as $item) {
            $data=array_only($item,$fill);
            $data['product_id']=$product_id;
            ProductDiscount::insert($data);
        }


        $fill=(new ProductSpecial)->getFillable();
        foreach ($request['special'] as $item) {
            $data=array_only($item,$fill);
            $data['product_id']=$product_id;
            ProductSpecial::insert($data);
        }
       
        $fill=(new ProductDescription)->getFillable();
        $data=array_only($request['general'],$fill);
        $data['product_id']=$product_id;
        $data['language_id']=1;
        return (new DataAction)->StoreData(ProductDescription::class,[],'',$data);
    }
    public function edit($id)
    {
        // dd($id);

        $Product['data']=ProductModel::find($id);
        $Product['general']=$Product['data']->Description()->first()->toArray();
        // dd($Product);
        return $Product;
    }
    public function update(Request $request,$id)
    {
         $fill = (new ProductModel)->getFillable();
        $data=array_only($request['data'],$fill);
        $dir='/images/product';
        $image=$request['data']['image'];
        if ($image) {
            $data['image']=$this->ImageMaker($dir,$image);
        }
        $data['date_modified']=date('Y-m-d h:i:s');
        ProductModel::find($id)->update($data);





        // insert product description
        $fill=(new ProductDescription)->getFillable();
        $data=array_only($request['general'],$fill);
        $data['product_id']=$id;
        $data['language_id']=1;
        $key['product_id']=$id;
        $key['language_id']=1;
        return ProductDescription::where($key)->update($data);
    }
    public function destroy($id)
    {
        return ProductModel::DeleteProduct($id);
    }
    public function ImageMaker($dir,$image)
    {
        if( preg_match('/data:image/', $image) ){                
            preg_match('/data:image\/(?<mime>.*?)\;/', $image , $groups);
            $mimetype = $groups['mime'];
            $file_name = uniqid().'.'.$mimetype;          
            $file_name=preg_replace('/\s/','', $file_name);
            $filepath = "$dir/$file_name";    
            $image = Image::make($image)->resize(400, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
            $image->save(public_path($filepath));     
            return $filepath;
        } 
        return false;
    }
}
