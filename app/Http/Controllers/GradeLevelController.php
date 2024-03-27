<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use Illuminate\Http\Request;

class GradeLevelController extends Controller
{
    protected $title, $title_page, $url_create, $url_index, $url_store, $url_edit, $url_update, $url_show, $url_destroy;
    public function __construct()
    {
        $this->title = 'Grade Level';
        $this->title_page = 'Grade Level';
        $this->url_create = 'grade-level.create';
        $this->url_index = 'grade-level.index';
        $this->url_store = 'grade-level.store';
        $this->url_edit = 'grade-level.edit';
        $this->url_update = 'grade-level.update';
        $this->url_show = 'grade-level.show';
        $this->url_destroy = 'grade-level.destroy';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title_page = $title = __("messages.grade_level");
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
                "type" => "text",
            ],
            [
                "name" => "name",
                "label" => __("messages.grade_level"),
                "type" => "text",
            ],
            [
                "name" => "created_at",
                "label" => __("messages.created_at"),
                "type" => "datetime",
            ],
            [
                "name" => "action",
                "label" => __("messages.action"),
                "type" => "action",
                "action_link" => [
                    "view" => $this->url_show,
                    "edit" => $this->url_edit,
                    "delete" => $this->url_destroy,
                ]
            ]
        ];

        $objects = GradeLevel::paginate(10);

        return view("layout.template.grade_level.index", compact('title_page', 'title', 'url_create', 'breadcrumb', 'dataTable', 'objects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $title_page = __("messages.grade_level");
        $url_show = $this->url_show;
        $url_store = $this->url_store;
        $url_index = $this->url_index;
        $breadcrumb = [
            [
                "url" => "dashboard.index",
                "title" => __("messages.dashboard"),
                "active" => false
            ],
            [
                "url" => $this->url_index,
                "title" => $title,
                "active" => false
            ],
            [
                "url" => null,
                "title" => __("messages.create"),
                "active" => true
            ]
        ];

        $dataType = [
            [
                "name" => "name",
                "label" => __("messages.grade_level"),
                "type" => "input:text",
            ]
        ];

        return view("layout.template.grade_level.create", compact('title_page', 'title', 'url_show', 'breadcrumb', 'dataType', 'url_store', 'url_index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $add_grade = GradeLevel::create($request->all());
        if ($add_grade) {
            return redirect()->route('grade-level.index')->with('success', "Grade Level created successfully.");
        } else {
            return redirect()->back()->with('error', "Grade Level created failed.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GradeLevel $gradeLevel)
    {
        $object = $gradeLevel;
        $title = $title_page = __("messages.grade_level");
        $url_show = $this->url_show;
        $url_edit = $this->url_edit;

        $breadcrumb = [
            [
                "url" => "dashboard.index",
                "title" => __("messages.dashboard"),
                "active" => false
            ],
            [
                "url" => $this->url_index,
                "title" => $title,
                "active" => false
            ],
            [
                "url" => null,
                "title" => __("messages.preview"),
                "active" => true
            ]
        ];

        $dataType = [
            [
                "name" => "name",
                "label" => __("messages.grade_level"),
                "type" => "input:text",
            ],
            [
                "name" => "created_at",
                "label" => __("messages.created_at"),
                "type" => "input:datetime",
            ],
            [
                "name" => "action",
                "label" => __("messages.action"),
                "type" => "action",
                "action_link" => [
                    "edit" => $this->url_edit,
                    "delete" => $this->url_destroy,
                ]
            ]
        ];

        return view("layout.template.grade_level.show", compact('title_page', 'title', 'url_show', 'breadcrumb', 'dataType', 'object', 'url_edit', 'url_show', 'url_edit', 'url_show', 'url_edit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GradeLevel $gradeLevel)
    {
        $object = $gradeLevel;
        $title = $title_page = __("messages.grade_level");
        $url_update = $this->url_update;
        $url_index = $this->url_index;

        $breadcrumb = [
            [
                "url" => "dashboard.index",
                "title" => __("messages.dashboard"),
                "active" => false
            ],
            [
                "url" => $this->url_index,
                "title" => $title,
                "active" => false
            ],
            [
                "url" => null,
                "title" => __("messages.edit"),
                "active" => true
            ]
        ];

        $dataType = [
            [
                "name" => "name",
                "label" => __("messages.grade_level"),
                "type" => "input:text",
            ]
        ];

        return view("layout.template.grade_level.update", compact('title_page', 'title', 'url_update', 'breadcrumb', 'dataType', 'object', 'url_index', 'url_update', 'url_index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GradeLevel $gradeLevel)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $update_grade = $gradeLevel->update($request->all());
        if ($update_grade) {
            return redirect()->route('grade-level.index')->with('success', 'Grade Level updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Grade Level updated failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradeLevel $gradeLevel)
    {
        $delete = $gradeLevel->delete();
        if ($delete) {
            return redirect()->route('grade-level.index')->with('success', 'Grade Level deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Grade Level deleted failed.');
        }
    }
}
