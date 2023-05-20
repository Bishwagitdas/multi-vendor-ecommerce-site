<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;



class BrandController extends Controller
{
    public function ShowAllBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.admin.brand.brand_all',compact('brands'));
    }
    public function AddBrand()
    {
        return view('backend.admin.brand.brand_add');
    }

 }
