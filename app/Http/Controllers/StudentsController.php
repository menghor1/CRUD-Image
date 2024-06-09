<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function index(){
        return view('students.index');
    }

    public function openAdd(){
        return view('students.add');
    }

    public function add(Request $request){
        $name = $request->name;
        $gender = $request->gender;
        $score1 = $request->score1;
        $score2 = $request->score2;
        $score3 = $request->score3;
        $profile = $request->profile;

        if($profile){
            $profileImage = rand(1,99999).'-'.$profile->getClientOriginalName();
            $path = 'Image';
            $profile->move($path,$profileImage);
        }

        $total = $score1+$score2+$score3;
        $average = $total/3;
        if($average >=90 ){
            $grade = 'A';
        }elseif($average >= 80){
            $grade = 'B';
        }
        elseif($average >= 70){
            $grade = 'C';
        }
        elseif($average >= 60){
            $grade = 'D';
        }
        elseif($average >= 60){
            $grade = 'E';
        }else{
            $grade = 'F';
        }
        $create_at = date('d-m-y h-i-s');
        try{
            DB::table("students")->insert([
                    'name'=>$name,
                    'gender'=>$gender,
                    'score1'=>$score1,
                    'score2'=>$score2,
                    'score3'=>$score3,
                    'total'=>$total,
                    'average'=>$average,
                    'grade'=>$grade,
                    'profile'=>$profileImage,
                    'create_at'=>$create_at,
                    ]);  

                return redirect('/add')->with('success','');
        }

        catch(Exception $e){
            return redirect('/add')->with('unsuccess','');
        }
        

        
        
    }

    public function view(){
        $students = DB::table('students')->select('*')->get();
        return view('students.view',compact('students'));
    }

    public function openUpdate($id)
    {
        $student = DB::table('students')->select('*')->where('id',$id)->first();

        return view('students.update',compact('student'));
    }

    public function update(Request $request){

        $id = $request->update_id;
        $name = $request->name;
        $gender = $request->gender;
        $score1 = $request->score1;
        $score2 = $request->score2;
        $score3 = $request->score3;
        $profile = $request->profile;

        if($profile){
            $profileImage = rand(1,99999).'-'.$profile->getClientOriginalName();
            $path = 'Image';
            $profile->move($path,$profileImage);
        }else{
            $profileImage = $request->old_profile;
        }


        $total = $score1+$score2+$score3;
        $average = $total/3;
        if($average >=90 ){
            $grade = 'A';
        }elseif($average >= 80){
            $grade = 'B';
        }
        elseif($average >= 70){
            $grade = 'C';
        }
        elseif($average >= 60){
            $grade = 'D';
        }
        elseif($average >= 60){
            $grade = 'E';
        }else{
            $grade = 'F';
        }

        $updated_at = date('d-m-y h-i-s');
        try{
          DB::table('students')->where('id',$id)->update([
                'name'=>$name,
                    'gender'=>$gender,
                    'score1'=>$score1,
                    'score2'=>$score2,
                    'score3'=>$score3,
                    'total'=>$total,
                    'average'=>$average,
                    'grade'=>$grade,
                    'profile'=>$profileImage,  
                    'updated_at'=>$updated_at,
                
          ]);
          return redirect('view')->with('updatesuccess','');
        }

        catch(Exception $e){
            return redirect('/update/'.$id)->with('updateunsuccess','');
        }
    }

    public function delete(Request $request){
        $id = $request->remove_id;
        try {
            DB::table('students')->where('id',$id)->delete();
            return redirect('/view')->with('deletesuccess','');
        } catch (Exception $e) {
            return redirect('/view')->with('deleteunsuccess','');
        }
    }

    public function search(Request $request){
        $query = $request->query_search;
        $result = DB::table('students')->where('name','LIKE','%'.$query.'%')->get();
        return view('students.search',compact('result'));            
    }

}
