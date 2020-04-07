<?php

namespace App\Http\Controllers\Admin;

use App\Patient;
use App\Surgical;
use Illuminate\Http\Request;
use App\SubSurgery;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SurgicalStoreRequest;
class SurgicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        if (request()->ajax()) {
            $nonSurgical = $patient->surgical;
            return response()->json($nonSurgical);
        }

        return view('admin.patient.surgical.index', compact('patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Patient $patient)
    {
        $surgery_sub_category = SubSurgery::lists('sub_surgery', 'sub_surgery');
        $surgerysubcategories = SubSurgery::get();
        //dd($surgerysubcategories);
        return view('admin.patient.surgical.create', compact('patient', 'surgery_sub_category', 'surgerysubcategories'));
    }

    public function store(SurgicalStoreRequest $request, Patient $patient)
    {

        $patient_uuid = $patient->patient_uuid;
        $surgical = new Surgical();
        $surgical->patient_id = $patient->id;
        $surgical->date_of_surgery = $request->date_of_surgery;
        $surgical->surgery_sub_category = $request->surgery_sub_category;
        
        if(isset($request->level_of_supervision) && isset($request->level_of_supervision[0])) {
            $surgical->level_of_supervision =  $request->level_of_supervision[0];
        }

        $surgical->description = $request->description;
        $surgical->surgery = json_encode($request->surgery);
        $surgical->complication = $request->complication;
        $surgical->date_of_review = $request->date_of_review;
        $surgical->save();


        $file = request()->file('learning_points');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('learning_points');
                 //->toMediaLibrary();

        }


        $file = request()->file('operative_notes');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('operative_notes');
                 //->toMediaLibrary();

        }

        $file = request()->file('intra_op');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('intra_op');
                 //->toMediaLibrary();

        }
       
        $file = request()->file('pre_op_xray');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('pre_op_xray');
                 //->toMediaLibrary();

        }

        $file = request()->file('post_op_xray');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('post_op_xray');
                 //->toMediaLibrary();

        $file = request()->file('follow_up_images');
        //dd(!isset($file), isset($file), $file);
        
        }
        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('follow_up_images');
                 //->toMediaLibrary();
        }

        return redirect()->route('surgical.index', ['patient' => $patient]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, Surgical $surgical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, Surgical $surgical)
    {
        $surgery_sub_category = SubSurgery::lists('sub_surgery', 'sub_surgery');
        $surgerysubcategories = SubSurgery::get();
        return view('admin.patient.surgical.edit', compact('patient', 'surgical', 'surgery_sub_category', 'surgerysubcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient, Surgical $surgical)
    {
        $patient_uuid = $patient->patient_uuid;
        $surgical->patient_id = $patient->id;
        $surgical->date_of_surgery = $request->date_of_surgery;
        $surgical->surgery_sub_category = $request->surgery_sub_category;
        

        if(isset($request->level_of_supervision) && isset($request->level_of_supervision[0])) {
            $surgical->level_of_supervision =  $request->level_of_supervision[0];
        }
        
        $surgical->description = $request->description;
        $surgical->surgery = json_encode($request->surgery);
        $surgical->complication = $request->complication;
        $surgical->date_of_review = $request->date_of_review;
        $surgical->save();

        $file = request()->file('learning_points');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('learning_points');
                 //->toMediaLibrary();

        }

        $file = request()->file('operative_notes');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('operative_notes');
                 //->toMediaLibrary();

        }

        $file = request()->file('intra_op');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('intra_op');
                 //->toMediaLibrary();

        }
       
        $file = request()->file('pre_op_xray');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('pre_op_xray');
                 //->toMediaLibrary();

        }

        $file = request()->file('post_op_xray');
        //dd(!isset($file), isset($file), $file);

        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('post_op_xray');
                 //->toMediaLibrary();

        $file = request()->file('follow_up_images');
        //dd(!isset($file), isset($file), $file);
        
        }
        if(isset($file)) {
        $extension = strtolower($file->getClientOriginalExtension());
            $mediaItems = $surgical->getMedia()->count() + 1;
            $filename = $patient_uuid . "_". $mediaItems;
            $file->move(public_path('media/'),$filename . '.' . $extension);
        
        $pathToFile  =  public_path('media/').$filename . '.' . $extension;
        $surgical->addMedia($pathToFile)->toCollection('follow_up_images');
                 //->toMediaLibrary();

        }

        return redirect()->route('surgical.index', ['patient' => $patient]);
    }

    public function delete(Patient $patient, Surgical $surgical)
    {
        return view('admin.patient.surgical.delete', compact('patient', 'surgical'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, Surgical $surgical)
    {
        $surgical->delete();
        return redirect()->route('surgical.index', ['patient' => $patient])->with('message', 'Surgical was successfully deleted!');
    }
}
