<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dose;
use App\Drug;
use App\SubSurgery;


use App\Http\Requests\DrugDoseStoreRequest;
use App\Http\Requests\DrugDoseUpdateRequest;

use App\Transformers\DrugTransformer;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\DataArraySerializer;

class SubSurgeryController extends Controller
{

        public function index()
    {
        if (request()->ajax()) {
            $subSurgery = SubSurgery::get();

            return response()->json($subSurgery);
        }

        return view('admin.subsurgery.index');
    }

    public function create()
    {
        $drugs = Drug::lists('name', 'name');
        $dose = Dose::lists('dose', 'id');
        $surgery = collect([]);
        return view('admin.subsurgery.create', compact('drugs', 'dose', 'surgery'));
    }

    public function store(Request $request)
    {
        $subSurgery = SubSurgery::firstOrCreate(['sub_surgery' => $request->sub_surgery]);
        $subSurgery->surgery = json_encode($request->surgery);
        $subSurgery->save();
        
        return redirect()->route('subsurgery.index')->with('message', 'SubSurgery was successfully created!');
    }

    public function edit(SubSurgery $subSurgery)
    {
        $drugs = Drug::lists('name', 'name');
        $sub_surgery = $subSurgery->sub_surgery;
        $surgery = json_decode($subSurgery->surgery);
        return view('admin.subsurgery.edit', compact('subSurgery', 'drugs', 'sub_surgery', 'surgery'));
    }

    public function update(Request $request)
    {
        $subSurgery = SubSurgery::firstOrCreate(['sub_surgery' => $request->sub_surgery]);
        //$surgery = $subSurgery->surgery ? json_decode($subSurgery->surgery,true) : [];
        //$surgery_merge = json_encode(array_unique(array_merge($surgery, $request->surgery)));
        //$subSurgery->surgery = $surgery_merge;
        $subSurgery->surgery = json_encode($request->surgery);
        $subSurgery->save();
        return redirect()->route('subsurgery.index')->with('message', 'SubSurgery was successfully updated!');
    }

    public function delete(SubSurgery $subSurgery)
    {
        return view('admin.subsurgery.delete', compact('subSurgery'));
    }

    public function destroy(SubSurgery $subSurgery)
    {
        $subSurgery->delete();
        return redirect()->route('dose.index')->with('message', 'SubSurgery was successfully deleted!');
    }

    public function show(SubSurgery $subSurgery)
    {
        return view('admin.subsurgery.show', compact('subSurgery'));
    }
}
