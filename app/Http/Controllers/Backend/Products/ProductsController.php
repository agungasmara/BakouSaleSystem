<?php

namespace App\Http\Controllers\Backend\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\BackEnd\Product\ProductModel;
use App\Http\Models\BackEnd\Product\ProductDescription;
use App\Http\Models\BackEnd\Product\ProductAttribute;
use App\Http\Models\BackEnd\Product\ProductToCategory;
use App\Http\Models\BackEnd\Product\ProductToCarrier;
use App\Http\Models\BackEnd\Product\ProductToStore;
use App\Http\Models\BackEnd\Product\CategoryToStore;
use App\Http\Models\BackEnd\Product\ProductFilter;
use App\Http\Models\BackEnd\Product\ProductRelated;
use App\Http\Models\BackEnd\Product\ProductOption;
use App\Http\Models\BackEnd\Product\ProductOptionValue;
use App\Http\Models\BackEnd\Product\ProductDiscount;
use App\Http\Models\BackEnd\Product\ProductSpecial;
use App\Http\Models\BackEnd\Product\ProductImage;
use App\Http\Models\BackEnd\Option\OptionDescription;
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

        ProductToCategory::where('product_id',$product_id)->delete();

        // ProductToCarrier::where('product_id',$product_id)->delete();

        ProductToStore::where('product_id',$product_id)->delete();

        ProductFilter::where('product_id',$product_id)->delete();

        ProductRelated::where('product_id',$product_id)->delete();

        ProductImage::where('product_id',$product_id)->delete();

        ProductAttribute::where('product_id',$product_id)->delete();

        ProductOption::where('product_id',$product_id)->delete();

        ProductOptionValue::where('product_id',$product_id)->delete();

        ProductDiscount::where('product_id',$product_id)->delete();

        ProductSpecial::where('product_id',$product_id)->delete();

        ProductDescription::where('product_id',$product_id)->delete();

        // if (isset($request['links']['carrier_id']) && $request['links']['carrier_id']) {
        //     # code...
        //     foreach ($request['links']['carrier_id'] as $item) {
        //         $p2cr['product_id']=$product_id;
        //         $p2cr['carrier_id']=$item;
        //         $p2cr['store_id']=config_store_id;
        //         ProductToCarrier::insert($p2cr);
        //     }
        // }

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
                ProductToStore::insert($p2s);
            }
        }

        if (isset($request['links']['filter_id']) && $request['links']['filter_id']) {
            # code...
            foreach ($request['links']['filter_id'] as $item) {
                $p2f['product_id']=$product_id;
                $p2f['filter_id']=$item;
                ProductFilter::insert($p2f);
            }
        }
        if (isset($request['links']['related_product']) && $request['links']['related_product']) {
            # code...
            foreach ($request['links']['related_product'] as $item) {
                $p2r['product_id']=$product_id;
                $p2r['related_id']=$item;
                ProductRelated::insert($p2r);
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
        $language_id=1;
        $Product['data']=ProductModel::find($id);
        $Product['general']=$Product['data']->Description()->first()->toArray();
        $Product['attributes']=ProductAttribute::where('product_id',$id)->get()->toArray();
        $Product['discount']=ProductDiscount::where('product_id',$id)->get()->toArray();
        $Product['gallery']=ProductImage::where('product_id',$id)->get()->toArray();
        $Product['links']['category_id']=array_pluck(ProductToCategory::where('product_id',$id)->get(['category_id'])->toArray(),'category_id');
        $Product['links']['store_id']=array_pluck(ProductToStore::where('product_id',$id)->get(['store_id'])->toArray(),'store_id');
        $Product['links']['filter_id']=array_pluck(ProductFilter::where('product_id',$id)->get(['filter_id'])->toArray(),'filter_id');
        $Product['links']['related_product']=array_pluck(ProductRelated::where('product_id',$id)->get(['related_id'])->toArray(),'related_id');
        // $Product['links']['downloads']=ProductRelated::where('product_id',$id)->get('downloads')->toArray();
        $Product['option']=ProductOption::where('product_id',$id)->get()->toArray();
        foreach ($Product['option'] as $key => $value) {
            $Product['option'][$key]['text']=strtolower(OptionDescription::where('option_id',$value['option_id'])->where('language_id',$language_id)->value('name'));
            if ($value) {
                $checkItem=ProductOptionValue::where('product_id',$id)->where('product_option_id',$value['product_option_id'])->get()->toArray();
                    $Product['option'][$key]['checkItem']=$checkItem;
            }
        }
        // [{"text":"textarea","option_id":6,"required":1,"value":null,"checkItem":[]}]
        // foreach ($request['option'] as $item) {
        //     $data=array_only($item,$fill);
        //     $data['product_id']=$product_id;
        //     if (isset($data['option_id'])) {
        //         $product_option_id=ProductOption::insertGetId($data);
        //         $fill=(new ProductOptionValue)->getFillable();
        //         if (isset($item['checkItem'])) {
        //             foreach ($item['checkItem'] as $value) {
        //                 $data=array_only($value,$fill);
        //                 $data['product_option_id']=$product_option_id;
        //                 $data['product_id']=$product_id;
        //                 $data['option_id']=$item['option_id'];
        //                 ProductOptionValue::insert($data);
        //             }
        //         }
        //     }
        // }
        $Product['special']=ProductSpecial::where('product_id',$id)->get()->toArray();
        // dd($Product);
        return $Product;
    }
    public function update(Request $request,$product_id)
    {
        $fill = (new ProductModel)->getFillable();
        $data=array_only($request['data'],$fill);
        $dir='/images/product';
        $image=$request['data']['image'];
        $data['image']=$this->ImageMaker($dir,$image);
        $data['date_added']=date('Y-m-d h:i:s');
        $data['date_modified']=date('Y-m-d h:i:s');
        ProductModel::find($product_id)->update($data);

        ProductToCategory::where('product_id',$product_id)->delete();

        ProductToStore::where('product_id',$product_id)->delete();

        ProductFilter::where('product_id',$product_id)->delete();

        ProductRelated::where('product_id',$product_id)->delete();

        ProductImage::where('product_id',$product_id)->delete();

        ProductAttribute::where('product_id',$product_id)->delete();

        ProductOption::where('product_id',$product_id)->delete();

        ProductOptionValue::where('product_id',$product_id)->delete();

        ProductDiscount::where('product_id',$product_id)->delete();

        ProductSpecial::where('product_id',$product_id)->delete();

        // ProductDescription::where('product_id',$product_id)->delete();


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
                ProductToStore::insert($p2s);
            }
        }
        if (isset($request['links']['filter_id']) && $request['links']['filter_id']) {
            # code...
            foreach ($request['links']['filter_id'] as $item) {
                $p2f['product_id']=$product_id;
                $p2f['filter_id']=$item;
                ProductFilter::insert($p2f);
            }
        }
        if (isset($request['links']['related_product']) && $request['links']['related_product']) {
            # code...
            foreach ($request['links']['related_product'] as $item) {
                $p2r['product_id']=$product_id;
                $p2r['related_id']=$item;
                ProductRelated::insert($p2r);
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
            if (isset($data['option_id'])) {
                $product_option_id=ProductOption::insertGetId($data);
                $fill=(new ProductOptionValue)->getFillable();
                if (isset($item['checkItem'])) {
                    foreach ($item['checkItem'] as $value) {
                        $data=array_only($value,$fill);
                        $data['product_option_id']=$product_option_id;
                        $data['product_id']=$product_id;
                        $data['option_id']=$item['option_id'];
                        ProductOptionValue::insert($data);
                    }
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
        dd($data);
        return (new DataAction)->UpdateData(ProductDescription::class,$data,'product_id',$product_id);
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
        return $image;
    }
}
