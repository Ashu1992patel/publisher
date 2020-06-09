<?php

namespace App\Http\Controllers;

use App\Shine;
use App\ShineCity;
use App\ShineDegreeLevel;
use Illuminate\Http\Request;

class ShineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getShineCity()
    {
        $shine_cities = ShineCity::where('city_grouping_id', request('shine_cities_groups_id'))->orderBy('city_desc')->cursor();
        // dd($shine_cities);

        return view('backend.ajax_forms.shine_cities', compact('shine_cities'));
    }

    public function getShineEducationStream()
    {
        // dd($_REQUEST);
        $shine_studies = ShineDegreeLevel::where('study_field_grouping_id', request('shine_study_field_grouping_id'))->orderBy('study_desc')->cursor();
        // dd($shine_cities);

        return view('backend.ajax_forms.shine_studies', compact('shine_studies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shine  $shine
     * @return \Illuminate\Http\Response
     */
    public function show(Shine $shine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shine  $shine
     * @return \Illuminate\Http\Response
     */
    public function edit(Shine $shine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shine  $shine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shine $shine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shine  $shine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shine $shine)
    {
        //
    }
}
