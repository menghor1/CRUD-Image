<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class StudentController extends Controller
{
    public function getAllStudent(){
        $students = DB::table('students')->select('*')->get();
        return response([
            'message'=>'success',
            'data'=>$students
        ]);
    }

    public function getStudentByID($id){
        $student = DB::table('students')->select('*')->where('id',$id)->first();
        if(empty($student)){
            return response([
                'message'=>'not found',
                'data'=>'Student '.$id.' not found'
            ])->setStatusCode(404);
        }
        return response([
            'message'=>'success',
            'data'=>$student
        ]);
    }

    public function addStudent(Request $request){
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
        // $create_at = date('d-m-y h-i-s');
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
                    // 'create_at'=>$create_at,
                    ]);  

                return response([
                    'message'=>'success',
                    'data'=>'add success'
                ])->setStatusCode(201);
        }

        catch(Exception $e){
            return response([
                'message'=>'Error',
                'data'=>'add not success'
            ])->setStatusCode(400);
        }
    }

    public function updateStudent(Request $request,$id){
        return $request;
        $name = $request->name;
        $gender = $request->gender;
        $score1 = $request->score1;
        $score2 = $request->score2;
        $score3 = $request->score3;

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
        // $create_at = date('d-m-y h-i-s');
        try{
            DB::table("students")->where('id',$id)->update([
                    'name'=>$name,
                    'gender'=>$gender,
                    'score1'=>$score1,
                    'score2'=>$score2,
                    'score3'=>$score3,
                    'total'=>$total,
                    'average'=>$average,
                    'grade'=>$grade,
                    // 'profile'=>$profileImage,
                    // 'create_at'=>$create_at,
                    ]);  

                return response([
                    'message'=>'success',
                    'data'=>'add success'
                ])->setStatusCode(201);
        }

        
        catch(Exception $e){
            return response([
                'message'=>'Error',
                'data'=>'update not success'.$e
            ]);
        }
        }

    

    public function deleteStudent($id){
        // $id = $request->remove_id;
        try {
            $student = DB::table('students')->where('id',$id)->delete();
            return response([
                'message'=>'delete success',
                'data'=>'delete success'
            ]);
        } catch (Exception $e) {
            return response([
                'message'=>'delete not success',
                'data'=>'delete not success'
            ]);
        }
    }
}

