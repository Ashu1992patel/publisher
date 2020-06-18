<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::cursor();
        return view('backend.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $default = new DefaultController();
            $extensions = $default->imageType();
            if ($request->hasFile('image') and in_array($request->image->extension(), $extensions)) {
                $image = $request->image;
                $fileName = time() . '.' . $image->getClientOriginalName();
                if (!file_exists('companies')) {
                    mkdir('companies/', 0777, true);
                }
                $image->move('companies/', $fileName);
                $image_path = 'companies/' . $fileName;
            } else {
                $image_path = '';
            }

            $company = new Company();
            $company->name = request('name');
            $company->website = request('website');
            $company->type = request('type');
            $company->address = request('address');
            $company->about = request('about');
            $company->image = $image_path;
            $company->created_by = auth()->user()->id;
            $company->save();

            return redirect()->back()->with('success', 'Company Details Has Been Saved Successfully !!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Oops!! Something Went Wrong, Please Try Again Later !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, $id)
    {
        $company = Company::find($id);
        return view('backend.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, $id)
    {
        $company = Company::find($id);
        return view('backend.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, $id)
    {
        try {
            $company = Company::find($id);
            $default = new DefaultController();
            $extensions = $default->imageType();
            if ($request->hasFile('image') and in_array($request->image->extension(), $extensions)) {
                $image = $request->image;
                $fileName = time() . '.' . $image->getClientOriginalName();
                if (!file_exists('companies')) {
                    mkdir('companies/', 0777, true);
                }

                $image->move('companies/', $fileName);
                $image_path = 'companies/' . $fileName;

                if (file_exists($company->image)) {
                    unlink($company->image);
                }
            } else {
                $image_path = $company->image;
            }


            $company->name = request('name');
            $company->website = request('website');
            $company->type = request('type');
            $company->address = request('address');
            $company->about = request('about');
            $company->image = $image_path;
            $company->created_by = auth()->user()->id;
            $company->save();

            return redirect()->back()->with('success', 'Company Details Has Been Updates Successfully !!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Oops!! Something Went Wrong, Please Try Again Later !!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, $id)
    {
        try {
            $company = Company::find($id);
            $image_path  = $company->image;
            $company->delete();

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            return redirect()->back()->with('success', 'Company Has Been Removed From Our Database !!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Oops!! Something Went Wrong, Please Try Again Later !!');
        }
    }
}
