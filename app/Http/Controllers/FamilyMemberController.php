<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Models\Family;

class FamilyMemberController extends Controller
{
    public function store(Request $request, $family_id)
    {
        $request->validate([
            'name' => 'required|string',
            'birthdate' => 'required|date',
            'marital_status' => 'required|in:Married,Unmarried',
            'wedding_date' => $request->marital_status === 'Married' ? 'required_if:marital_status,Married|date' : '',
            'education' => 'nullable|string',
            'photo' => 'nullable|image|max:2048' // Assuming photo upload is handled separately
        ]);

        $familyMember = new FamilyMember();
        $familyMember->name = $request->name;
        $familyMember->head_family_id = $family_id;
        $familyMember->birthdate = $request->birthdate;
        $familyMember->marital_status = $request->marital_status;
        if ($request->marital_status === 'Married') {
            $familyMember->wedding_date = $request->wedding_date;
        }
        $familyMember->education = $request->education;

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $dir        = 'app/public/uploads';
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->photo->move(storage_path($dir), $fileNameToStore);
            $familyMember->photo = $fileNameToStore;
        }
        // Handle photo upload separately and store file path in database if needed

        $familyMember->save();
        return redirect()->route('family.member.show', ['family_id' => $family_id])->with('success', 'Family member information saved successfully!');

        //return redirect('family/'.$family_id.'/memberDetails')->with('success', 'Family member information saved successfully!');
    }
  
    public function create($family_id)
    {
        // You can pass the family ID to the create view if needed
        return view('family.familyMember', compact('family_id'));
    }

    public function show($family_id)
    {
        $family_name = Family::where('id',$family_id)->first();
        $members = FamilyMember::where('head_family_id', $family_id)->paginate(10);
        return view('family.memberDetails', compact('members','family_name'));
    }
}
