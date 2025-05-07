<?php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Course;
use App\Models\Location;
use App\Models\Student;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
class DropdownController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('dropdown', compact('departments'));
    }

    public function getCourses($department_id)
    {
        $courses = Course::where('department_id', $department_id)->get();
        return response()->json($courses);
    }

    public function getLocations($course_id)
    {
        $locations = Location::where('course_id', $course_id)->get();
        return response()->json($locations);
    }

    public function getStudents($location_id)
    {
        $students = Student::where('location_id', $location_id)->get();
        return response()->json($students);
    }
}
?>