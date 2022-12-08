<?php

namespace App\Http\Controllers;
use App\Models\Auth;
use App\Models\Mark;
use App\Models\User;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Assignment;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Notifications\NewAssignmentNotification;
use Illuminate\Support\Facades\Notification;

class TeacherController extends Controller
{
    public function teacherdashboard()
    {
        $courseID = auth()->user()->course_id;
        $users = User::where('role_as', '0')->where('course_id', $courseID)->count();
        $announcments = Announcement::where('user_id', auth()->user()->id)->count();
        $assignments = Assignment::where('user_id', auth()->user()->id)->count();
        return view('teacher.dashboard', compact('users', 'announcments', 'assignments'));
    }

    public function assignment()
    {
        $course = Course::where('id', auth()->user()->course_id)->first();
        $subjects = Subject::where('course_id', auth()->user()->course_id)->get();
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('teacher.assignment', compact('course', 'subjects' , 'min_date' , 'max_date'));
    }

    public function addassignment(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'subject_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'marks' => 'required|numeric|digits:2',
            'submission' => 'required|after:today',
            'image' => 'required',
        ]);
        $users = User::where('role_as', '0')->get();
        $admins = User::where('role_as', '1')->get();
        $teachers = User::where('role_as', '2')->get();
        $assignment = new Assignment();
        $assignment->course_id = $request->course_id;
        $assignment->subject_id = $request->subject_id;
        $assignment->user_id = $request->user_id;
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->marks = $request->marks;
        $assignment->submission = $request->submission;
        $image = $request->file('image')->store('public/images');
        $assignment->image = $image;
        $res = $assignment->save();
        if ($res == true) {
            Notification::send($admins, new NewAssignmentNotification($assignment));
            Notification::send($users, new NewAssignmentNotification($assignment));
            return back()->with('success', 'Assignment Added Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function manageassignment()
    {
        $assignments = Assignment::where('user_id', auth()->user()->id)->get();
        return view('teacher.manageassignment', compact('assignments'));
    }

    public function showeditassignment(Assignment $assignment)
    {
        $course = Course::where('id', auth()->user()->course_id)->first();
        $subjects = Subject::where('course_id', auth()->user()->course_id)->get();
        return view('teacher.editassignment', compact('assignment', 'course', 'subjects'));
    }

    public function deleteassignment(Assignment $assignment)
    {
        $assignment->delete();
        return back()->with('success', 'Assignment Deleted Successfuly!');
    }

    public function editassignment(Request $request, $id)
    {
        $assignment = Assignment::find($id);
        $assignment->course_id = $request->course_id;
        $assignment->subject_id = $request->subject_id;
        $assignment->user_id = auth()->user()->id;
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->marks = $request->marks;
        $assignment->submission = $request->submission;
        $image = $request->file('image')->store('public/images');
        $assignment->image = $image;
        $res = $assignment->update();
        if ($res == true) {
            return back()->with('success', 'Assignment Updated Successfully!');
        } else {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function announcment()
    {
        $announcments = Announcement::where('user_id', auth()->user()->id)->get();
        return view('teacher.announcment', compact('announcments'));
    }

    public function addannouncment(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $announcment = new Announcement();
        $announcment->user_id = auth()->user()->id;
        $announcment->course_id = auth()->user()->course_id;
        $announcment->title = $request->title;
        $announcment->description = $request->description;
        $res = $announcment->save();
        if ($res) {
            return back()->with('success', 'Announcment Added Successfuly!');
        } else {
            return back()->with('fail', 'There Is Something Wrong!');
        }
    }

    public function deleteannouncment(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announement Deleted Successfuly!');
    }

    public function registeredusers()
    {
        $courseID = auth()->user()->course_id;
        $users = User::where('role_as', '0')->where('course_id', $courseID)->get();
        return view('teacher.registeredusers', compact('users'));
    }

    public function unchecked(Answer $answer)
    {
        $assignments = Assignment::where('user_id', auth()->user()->id)->where('status', 'Unchecked')->get();
        return view('teacher.uncheckedassignment', compact('assignments', 'answer'));
    }

    public function checked()
    {
        $assignments = Assignment::where('user_id', auth()->user()->id)->where('status', 'Checked')->get();
        return view('teacher.checkedassignment', compact('assignments'));
    }

    public function checkassignment($id)
    {
        $assignments = Assignment::find($id);
        $assignments->status = 'Checked';
        $assignments->save();
        return back();
    }

    public function uncheckassignment($id)
    {
        $assignments = Assignment::find($id);
        $assignments->status = 'Unchecked';
        $assignments->save();
        return back();
    }

    public function showanswer($id)
    {
        $answers = Answer::where('assignment_id', $id)->get();
        $marks = [];
        foreach ($answers as $answer) {
            $marks = Mark::where('answer_id', $answer->id)->get();
        }
        return view('teacher.answerteacher', compact('answers', 'marks'));
    }

    public function givemark()
    {
        return view('teacher.givemark');
    }

    public function submitmark(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'mark' => 'required|digits:2',
        ]);

        $mark = new Mark();
        $mark->user_id = auth()->user()->id;
        $mark->answer_id = $request->answer_id;
        $mark->description = $request->description;
        $mark->mark = $request->mark;
        if (!Mark::where('user_id', auth()->user()->id)->where('answer_id', $request->answer_id)->exists()) {
            $res = $mark->save();
        } else {
            return back()->with('fail', 'Teacher Can Only Give Mark Once!');
        }
        if ($res) {
            return back()->with('success', 'Mark Given Successfuly!');
        } else {
            return back()->with('fail', 'There Is Something Wrong!');
        }
    }

    public function search()
    {
        return view('teacher.searchteacher');
    }

    public function fullsearch(Request $request)
    {
        $request->validate([
            'find' => 'required',
        ]);
        $search_text = $_GET['find'];
        $assignments = DB::table('assignments')
            ->join('courses', 'courses.id', '=', 'assignments.course_id')
            ->join('subjects', 'subjects.id', '=', 'assignments.subject_id')
            ->join('users', 'users.id', '=', 'assignments.user_id')
            ->select(
                'assignments.id',
                'assignments.title',
                'assignments.description',
                'assignments.marks',
                'assignments.submission',
                'assignments.image',
                'assignments.status',
                'users.fname',
                'users.lname',
                'users.email',
                'courses.course',
                'courses.branch',
                'subjects.subjectfullname',
                'subjects.subjectshortname'
            )
            ->where('assignments.title', 'LIKE', '%' . $search_text . '%')
            ->orWhere('users.fname', 'LIKE', '%' . $search_text . '%')
            ->get();
        return view('teacher.resultsearch', compact('assignments'));
    }

    public function changeteacherpassword()
    {
        return view('teacher.changeteacherpassword');
    }

    public function updateteacherpassword(Request $request)
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

    public function updateteacher()
    {
        return view('teacher.updateteacher');
    }

}
