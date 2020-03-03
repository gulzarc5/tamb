<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class SlotController extends Controller
{
    public function slotInsert(Request $request)
    {
       $slot = $request->input('slot'); // array of data
       $numbers = $request->input('numbers'); //array of data

       if (isset($slot) && !empty($slot)) {
           for ($i=0; $i < count($slot); $i++) { 
               if (isset($slot[$i]) && isset($numbers[$i]) && !empty($slot[$i]) && !empty($numbers[$i])) {

                    $slot_check = DB::table('generated_number')->where('slot_no',$slot[$i])->count();
                    if ($slot_check == 0) {
                        $no_check = DB::table('generated_number')->where('number',$numbers[$i])->count();
                        if ($no_check == 0) {
                            DB::table('generated_number')
                                ->insert([
                                    'slot_no' => $slot[$i],
                                    'number' => $numbers[$i],                        
                                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                                ]);
                        }
                    }
               }
           }
       }
       return redirect()->back();
    }

    public function slotEdit($slot_id)
    {
        $slot_data = DB::table('generated_number')->where('id',$slot_id)->first();
        return view('admin.slot_edit',compact('slot_data'));
    }

    public function slotUpdate(Request $request)
    {
        $this->validate($request, [
            'slot_id'   => 'required|numeric',
            'slot'   => 'required|numeric',
            'number' => 'required|numeric'
        ]);
        $slot_id = $request->input('slot_id');
        $slot = $request->input('slot');
        $number = $request->input('number');
        $slot_data = DB::table('generated_number')->where('id',$slot_id)->first();
        $slot_check = DB::table('generated_number')->where('slot_no',$slot)->where('id','!=',$slot_id)->count();
        if ($slot_check == 0) {
            $no_check = DB::table('generated_number')->where('number',$number)->where('id','!=',$slot_id)->count();
            if ($no_check == 0) {
                DB::table('generated_number')
                    ->where('id',$slot_id)
                    ->update([
                        'slot_no' => $slot,
                        'number' => $number,                        
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }else{
                return redirect()->back()->with('error',"Numer $number Is Already Assigned to another slot please choose another number");
            }
        }else{
            return redirect()->back()->with('error',"Slot $slot Already Exist Please Delete Or Edit Slot");
        }
        return redirect()->back()->with('message',"Slot Data Updated Successfully");
    }

    public function slotDelete($slot_id)
    {
        DB::table('generated_number')->where('id',$slot_id)->delete();
        return redirect()->back();
    }
}
