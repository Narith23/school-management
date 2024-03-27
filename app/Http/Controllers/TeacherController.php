<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Construct
     */
    protected $title, $title_page, $url_create, $url_index, $url_store, $url_edit, $url_update, $url_show, $url_destroy;

    public function __construct()
    {
        $this->url_create = 'teacher.create';
        $this->url_index = 'teacher.index';
        $this->url_store = 'teacher.store';
        $this->url_edit = 'teacher.edit';
        $this->url_update = 'teacher.update';
        $this->url_show = 'teacher.show';
        $this->url_destroy = 'teacher.destroy';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title_page = $title = __("messages.teacher");
        $url_create = $this->url_create;

        $breadcrumb = [
            [
                'url' => 'dashboard.index',
                'title' => __("messages.dashboard"),
                'active' => false
            ],
            [
                'url' => null,
                'title' => $title,
                'active' => true
            ]
        ];

        $dataTable = [
            [
                "name" => "id",
                "label" => __("messages.id"),
                "type" => "input:text",
            ],
            [
                "name" => "user_id",
                "label" => __("messages.teacher_name"),
                'type' => 'option:relationship',
                'relationship' => 'user',
                'attribute' => 'name',
            ],
            [
                "name" => "subject_id",
                "label" => __("messages.subject"),
                "type" => "option:relationship",
                "relationship" => "subject",
                "attribute" => "name",
            ]
        ];

        $objects = Teacher::paginate(10);

        return view("layout.template.teachers.index", compact("title_page", "title", "url_create", "breadcrumb", "dataTable", "objects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title_page = $title = __("messages.teacher");
        $url_show = $this->url_show;
        $url_store = $this->url_store;
        $url_index = $this->url_index;

        $breadcrumb = [
            [
                'url' => 'dashboard.index',
                'title' => __("messages.dashboard"),
                'active' => false
            ],
            [
                'url' => $this->url_index,
                'title' => $title,
                'active' => false
            ],
            [
                'url' => null,
                'title' => __("messages.create"),
                'active' => true
            ]
        ];

        $dataType = [
            [
                "name" => "user_id",
                "label" => __("messages.teacher_name"),
                "type" => "option:select",
                "options" => User::pluck('name', 'id'),
            ],
            [
                "name" => "subject_id",
                "label" => __("messages.subject"),
                "type" => "option:select",
                "option" => Subject::pluck('name', 'id'),
            ],
            [
                "name" => "gender_id",
                "label" => __("messages.gender"),
                "type" => "option:select",
                "option" => Gender::pluck('name', 'id'),
            ]
        ];

        return view("layout.template.teachers.create", compact("title_page", "title", "url_show", "url_store", "url_index", "breadcrumb", "dataType"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "user_id" => "required",
            "subject_id" => "required",
            "gender_id" => "required"
        ]);

        $add_teacher = Teacher::create($request->all());
        if ($add_teacher) {
            return redirect()->route($this->url_index)->with("success", "Teacher created successfully.");
        } else {
            return redirect()->back()->with("error", "Teacher created failed");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $object = $teacher;
        $title = $title_page = __("messages.subject");
        $url_edit = $this->url_edit;
        $url_update = $this->url_update;

        $breadcrumb = [
            [
                'url' => 'dashboard.index',
                'title' => __("messages.dashboard"),
                'active' => false
            ],
            [
                'url' => $this->url_index,
                'title' => $title,
                'active' => false
            ],
            [
                'url' => null,
                'title' => __("messages.show"),
                'active' => true
            ]
        ];

        $dataType = [
            [
                "name" => "user_id",
                "label" => __("messages.teacher_name"),
                "type" => "option:select",
                "options" => User::pluck('name', 'id'),
            ],
            [
                "name" => "subject_id",
                "label" => __("messages.subject"),
                "type" => "option:relationship",
                "relationship" => "subject",
                "empty" => "subject",
                "attribute" => "name"
            ],
            [
                "name" => "gender_id",
                "label" => __("messages.gender"),
                "type" => "option:relationship",
                "relationship" => "gender",
                "empty" => "gender",
                "attribute" => "name"
            ]
        ];

        return view("layout.template.teachers.update", compact("title_page", "title", "url_update", "url_index", "breadcrumb", "dataType", "object"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $object = $teacher;
        $title = $title_page = __("messages.teacher");
        $url_update = $this->url_update;
        $url_index = $this->url_index;

        $breadcrumb = [
            [
                'url' => 'dashboard.index',
                'title' => __("messages.dashboard"),
                'active' => false
            ],
            [
                'url' => $this->url_index,
                'title' => $title,
                'active' => false
            ],
            [
                'url' => null,
                'title' => __("messages.edit"),
                'active' => true
            ]
        ];

        $dataType = [
            [
                "name" => "user_id",
                "label" => __("messages.teacher_name"),
                "type" => "option:select",
                "options" => User::pluck('name', 'id'),
            ],
            [
                "name" => "subject_id",
                "label" => __("messages.subject"),
                "type" => "option:select",
                "option" => Subject::pluck('name', 'id'),
            ],
            [
                "name" => "gender_id",
                "label" => __("messages.gender"),
                "type" => "option:select",
                "option" => Gender::pluck('name', 'id'),
            ]
        ];

        return view("layout.template.teachers.update", compact("title_page", "title", "url_update", "url_index", "breadcrumb", "dataType", "object"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            "user_id" => "required",
            "subject_id" => "required",
            "gender_id" => "required"
        ]);

        $update_teacher = $teacher->update($request->all());
        if ($update_teacher) {
            return redirect()->route($this->url_index)->with("success", "Teacher updated successfully.");
        } else {
            return redirect()->back()->with("error", "Teacher updated failed.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $delete_teacher = $teacher->delete();
        if ($delete_teacher){
            return redirect()->route($this->url_index)->with("success", "Teacher deleted successfully.");
        } else {
            return redirect()->back()->with("error", "Teacher delete failed.");
        }
    }
}
