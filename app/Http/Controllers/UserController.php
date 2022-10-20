<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\News;
use App\Models\User;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Assignment;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserNotification;
use App\Notifications\NewAnswerNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Auth\Authenticatable;


class UserController extends Controller
{



    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUser = auth()->user();

            $this->user = Auth::user();

            return $next($request);
        });
    }


    public function home(Request $request)
    {
        $courses = Course::all();
        $subjects = Subject::all();
        $news = News::all();
        return view('home', compact('courses', 'news', 'subjects'));
    }

    public function registeration(Request $request)
    {
        $request->validate([

            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:8',
            'repassword' => 'required|same:password',
            'birthday' => 'required|before:5 years ago',
            'image' => 'required',
            'gender' => 'required'

        ]);
        $admins = User::where('role_as', '1')->get();
        $teachers = User::where('role_as', '2')->get();
        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->course_id = $request->course_id;
        $user->password = Hash::make($request->password);
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        if ($file = $request->file('image')) {
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $destinationPath = "uploads/";
            $file->move($destinationPath, $filename);
            $input['image'] = "$filename";
        }
        $user->image = $request->image;
        $res = $user->save();
        if ($res == true) {
            Notification::send($admins, new NewUserNotification($user));
            Notification::send($teachers, new NewUserNotification($user));
            return redirect('/login')->with('success', 'User Registered Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function login()
    {
        return view('student.login');
    }

    public function loginUser(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // $user = Auth::user();
        $user = User::where('email', request('email'))->first();
        if ($user == null) {
            return back()->with('fail', 'We Dont Have Any User With This Email!');
        } else {
            auth()->attempt($request->only(['email', 'password']));
            if (Hash::check(request('password'), $user->password)) {
                // Admin:
                if ($user->role_as == '1') {
                    $courses = Course::count();
                    $subjects = Subject::count();
                    $users = User::where('role_as', '2')->count();
                    $notifications = $request->user()->notifications->where('type', 'user')->all();
                    return view('admin.dashboard', compact('courses', 'subjects', 'users', 'notifications'))->with('success', 'Welcome to Admin Dashboard!');
                    // User:
                } elseif ($user->role_as == '0') {
                    $announcments = Announcement::where('course_id', $user->course_id)->get();
                    $notifications = $request->user()->notifications->all();
                    return view('student.dashboard', compact('announcments', 'notifications'))->with('success', 'Logged In Successfully!');
                    // Teacher:
                } elseif ($user->role_as == '2') {
                    $courseID = $user->course_id;
                    $users = User::where('role_as', '0')->where('course_id', $courseID)->count();
                    $announcments = Announcement::where('user_id', $user->id)->count();
                    $assignments = Assignment::where('user_id', $user->id)->count();
                    $notifications = $request->user()->notifications->all();
                    return view('teacher.dashboard', compact('users', 'assignments', 'announcments', 'notifications'))->with('success', 'Logged In Successfully!');
                } else {
                    return back()->with('fail', 'Password Didnt Match!');
                }
            } else {
                return back()->with('fail', 'The Password Or Email Is Wrong!');
            }
        }
    }

    public function studentdashboard()
    {
        $announcments = Announcement::where('course_id', auth()->user()->course_id)->get();
        return view('student.dashboard', compact('announcments'));
    }

    public function updatestudent()
    {
        return view('student.updatestudent');
    }

    public function newassignment()
    {
        $courseID = auth()->user()->course_id;
        $assignments = Assignment::where('course_id', $courseID)->get();
        Assignment::increment('views');
        return view('student.newassignment', compact('assignments'));
    }

    public function answer()
    {
        return view('student.answer');
    }

    public function addanswer(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required',
        ]);
        $teachers = User::where('role_as', '2')->get();
        $answer = new Answer();
        $answer->user_id = auth()->user()->id;
        $answer->course_id = auth()->user()->course_id;
        $answer->assignment_id = $request->assignment_id;
        $answer->description = $request->description;
        if ($file = $request->file('image')) {
            $filename = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $destinationPath = "uploads/";
            $file->move($destinationPath, $filename);
            $input['image'] = "$filename";
        }
        $answer->image = $request->image;
        if (!Answer::where('user_id', auth()->user()->id)->where('assignment_id', $request->assignment_id)->exists()) {
            $res = $answer->save();
        } else {
            return back()->with('fail', 'You Can Only Answer Once!');
        }
        if ($res == true) {
            Notification::send($teachers, new NewAnswerNotification($answer));
            return back()->with('success', 'Answer Submitted Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function uploade()
    {
        $assignments = Assignment::where('course_id', auth()->user()->course_id)->get();
        return view('student.uploaded', compact('assignments'));
    }

    public function showanswerstudent($id)
    {
        $answers = Answer::where('assignment_id', $id)->get();
        $marks = [];
        foreach ($answers as $answer) {
            $marks = Mark::where('answer_id', $answer->id)->get();
        }
        return view('student.answerstudent', compact('answers', 'marks'));
    }

    public function changestudentpassword()
    {
        return view('student.changestudentpassword');
    }

    public function updatestudentpassword(Request $request)
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



    public function logout()
    {
        auth()->logout();
        return redirect('login')->with('success', 'You LoggedOut Successfully');
    }
}
