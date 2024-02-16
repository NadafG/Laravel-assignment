<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Family;

class FamilyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'birthdate' => 'required|date|before_or_equal:-21 years',
            'mobile_no' => 'required|numeric',
            'address' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|numeric',
            'marital_status' => 'required|string|in:Married,Unmarried',
            'wedding_date' => $request->input('marital_status') == 'Married' ? 'required|date' : '',
            'hobbies.*' => 'string',
            'photo' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        
        $family = new Family();
        $family->name = $request->input('name');
        $family->surname = $request->input('surname');
        $family->birthdate = $request->input('birthdate');
        $family->mobile_no = $request->input('mobile_no');
        $family->address = $request->input('address');
        $family->state = $request->input('state');
        $family->city = $request->input('city');
        $family->pincode = $request->input('pincode');
        $family->marital_status = $request->input('marital_status');
        $family->wedding_date = $request->input('wedding_date');
        if ($request->has('hobbies')) {
            foreach ($request->input('hobbies') as $hobby) {
                //$family->hobbies()->create(['name' => $hobby]);
                $hobbiesString = implode(',', $request->input('hobbies'));
                $family->hobbies = $hobbiesString;
            }
        }
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $dir        = 'app/public/uploads';
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->photo->move(storage_path($dir), $fileNameToStore);
            $family->photo = $fileNameToStore;
        }
        $family->save();
        return redirect('/family/details')->with('success', 'Family information saved successfully!');
    }
    public function create()
    {
        $data = File::get(public_path('storage/states-and-districts.json'));
        $states = json_decode($data, true)['states'];
        return view('family.create',compact('states'));
    }

    public function details()
    {
        $families = Family::paginate(10);
        return view('family.details', compact('families'));
    }
   
}




