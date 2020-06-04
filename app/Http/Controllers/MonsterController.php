<?php

namespace App\Http\Controllers;

use App\MonsterCategoryRoleMapping;
use App\MonsterEducationStream;
use App\MonsterIndustryCategoryMapping;
use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function getIndustryCategoryFunction()
    {
        // dd($_REQUEST);
        $monsterIndustryCategoryMapping = MonsterIndustryCategoryMapping::where('industry_id', request('monster_industry_id'))->cursor();

        return view('backend.ajax_forms.category_function', compact('monsterIndustryCategoryMapping'));
    }

    public function getCategoryRole()
    {
        // dd($_REQUEST);
        $monster_category_role_mappings = MonsterCategoryRoleMapping::where('category_id', request('monster_category_function_id'))->cursor();

        return view('backend.ajax_forms.category_role', compact('monster_category_role_mappings'));
        // dd($monsterIndustryCategoryMapping);
    }

    public function getMonsterEducationStream()
    {
        // dd($_REQUEST);
        $monster_education_streams = MonsterEducationStream::where('level_id', request('monster_education_level_id'))->cursor();

        return view('backend.ajax_forms.monster_education_stream', compact('monster_education_streams'));
        // dd($monsterIndustryCategoryMapping);
    }
}
