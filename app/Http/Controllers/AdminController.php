<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\News;
use App\Models\User;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Activity;
use App\Models\Assignment;
use App\Notifications\NewUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUser = auth()->user();

            return $next($request);
        });
    }
    public function admindashboard()
    {
        $courses = Course::count();
        $subjects = Subject::count();
        $users = User::where('role_as', '2')->count();
        return view('admin.dashboard', compact('courses', 'subjects', 'users'));
    }

    public function updateadmin()
    {
        return view('admin.updateadmin');
    }

    public function adminupdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $image = $request->file('image')->store('public/images');
        $user->image = $image; 
        $res = $user->update();
        if ($res == true) {
            return back()->with('success', 'User Updated Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function course()
    {
        $courses = Course::all();
        return view('admin.course', compact('courses'));
    }

    public function savecourse(Request $request)
    {
        $request->validate([
            'course' => 'required',
            'branch' => 'required',
        ]);

        $course = new Course();
        $course->course = $request->course;
        $course->branch = $request->branch;
        $res = $course->save();
        if ($res == true) {
            return back()->with('success', 'Course Added Successfully!');
        } else {
            return back()->with('fail', 'There Is Something Wrong!');
        }
    }
    public function deletecourse(Course $course)
    {
        // $course = Course::findOrfail($id);
        $course->delete();
        return back()->with('success', 'Course Deleted Successfuly!');
    }

    public function showeditcourse(Course $course)
    {
        return view('admin.editcourse', compact('course'));
    }

    public function editcourse(Request $request, Course $course)
    {
        $input = $request->all();
        $res = $course->update($input);
        if ($res) {
            return back()->with('success', 'Course Updated Successfuly!');
        } else {
            return back()->with('fail', 'There Is Something Wrong!');
        }
    }

    public function subject()
    {
        $courses = Course::all();
        $subjects = Subject::all();
        return view('admin.subject', compact('courses', 'subjects'));
    }

    public function savesubject(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'subjectfullname' => 'required',
            'subjectshortname' => 'required'
        ]);

        $subject = new Subject();
        $subject->course_id = $request->course_id;
        $subject->subjectfullname = $request->subjectfullname;
        $subject->subjectshortname = $request->subjectshortname;
        $res = $subject->save();
        if ($res) {
            return back()->with('success', 'Subject Added Successfuly!');
        } else {
            return back()->with('fail', 'There Is Something Wrong!');
        }
    }

    public function deletesubject(Subject $subject)
    {
        $subject->delete();
        return back()->with('success', 'Subject Deleted Successfuly!');
    }

    public function editsubject(Request $request, Subject $subject)
    {
        $input = $request->all();
        $res = $subject->update($input);
        if ($res) {
            return back()->with('success', 'Subject Updated Successfuly!');
        } else {
            return back()->with('fail', 'There Is Something Wrong!');
        }
    }
    public function showeditsubject(Subject $subject)
    {
        $courses = Course::all();
        return view('admin.editsubject', compact('subject', 'courses'));
    }

    public function teacher()
    {
        $courses = Course::all();
        return view('admin.addteacher', compact('courses'));
    }

    public function addteacher(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:8',
            'repassword' => 'required|same:password',
            'course_id' => 'required',
            'birthday' => 'required|before:5 years ago',
            'role_as' => 'required|numeric|min:0|max:2',
            'image' => 'required',
            'gender' => 'required'

        ]);

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->course_id = $request->course_id;
        $user->birthday = $request->birthday;
        $user->role_as = $request->role_as;
        $user->gender = $request->gender;
        $image = $request->file('image')->store('public/images');
        $user->image = $image;
        $res = $user->save();
        if ($res == true) {
            return back()->with('success', 'Teacher Registered Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function manageteacher()
    {
        $users = User::where('role_as', '2')->get();
        return view('admin.manageteacher', compact('users'));
    }

    public function deleteteacher(User $user, $id)
    {
        $user = User::find($id)->delete();
        return back()->with('success', 'Teacher Deleted Successfuly!');
    }

    public function showeditteacher($id)
    {
        $courses = Course::all();
        $user = User::find($id);
        return view('admin.editteacher', compact('user', 'courses'));
    }

    public function editteacher(Request $request, $id)
    {

        $user = User::find($id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->course_id = $request->course_id;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $image = $request->file('image')->store('public/images');
        $user->image = $image;
        $res = $user->update();
        if ($res == true) {
            return back()->with('success', 'Teacher Updated Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function news()
    {
        $newss = News::all();
        return view('admin.news', compact('newss'));
    }

    public function addnews(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        $res = $news->save();
        if ($res) {
            return back()->with('success', 'News Added Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function deletenews(News $news)
    {
        $news->delete();
        return back()->with('success', 'News Deleted Successfuly!');
    }

    public function checkedadmin(Answer $answer)
    {
        $assignments = Assignment::where('status', 'Checked')->get();
        return view('admin.unchecked', compact('assignments', 'answer'));
    }

    public function uncheckedadmin(Answer $answer)
    {
        $assignments = Assignment::where('status', 'Unchecked')->get();
        return view('admin.checked', compact('assignments', 'answer'));
    }

    public function showansweradmin($id)
    {
        $answers = Answer::where('assignment_id', $id)->get();
        $marks = [];
        foreach ($answers as $answer) {
            $marks = Mark::where('answer_id', $answer->id)->get();
        }
        return view('admin.answeradmin', compact('answers', 'marks'));
    }

    public function search()
    {
        return view('admin.search');
    }

    public function searchassignment(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $data = DB::select("SELECT * FROM assignments WHERE created_at BETWEEN '$fromDate 00:00:00' AND '$toDate 23:59:59'");
        return view('admin.searchresult',  compact('data'));
    }

    public function changeadminpassword()
    {
        return view('admin.changeadminpassword');
    }

    public function updateadminpassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'newconfirmedpassword' => 'required|same:newpassword'
        ]);

        if (!Hash::check($request->oldpassword, auth()->user()->password)) {

            return back()->with('fail', 'Old Password Does not Match!');
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newpassword)
        ]);

        return redirect('/login')->with('success', 'Password Changed Successfully!');
    }

    public function statistics()
    {
        $activities = Activity::paginate(7);
        $i = 0;
        return view('admin.statistics', compact('activities' , 'i'));
    }

    public function deletestatistics()
    {

        Activity::truncate();
        return back()->with('success', 'Statistics Deleted Successfuly!');
    }

    public function markasread(Request $request)
    {
        if ($request->notification_id) {
            auth()->user()->unreadnotifications->where($request->notification_id)->markAsRead();
        }
        return response([
            'status' => true
        ]);
    }

    public function allusers()
    {
        $i = 0;
        $users = User::where('role_as', '!=', '1')->get();
        return view('admin.allusers', compact('i' , 'users'));
    }

    public function deleteallusers(Request $request)
    {
        // dd($request->ids);
        $ids = $request->ids;
        User::WhereIn('id' , $ids)->delete();
        return back()->with('success', 'User Deleted Successfully');
    }
}
