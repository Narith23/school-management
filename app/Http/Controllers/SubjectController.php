<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Construct
     */
    protected $title, $title_page, $url_create, $url_index, $url_store, $url_edit, $url_update, $url_show, $url_destroy;

    public function __construct()
    {
        $this->url_create = 'subject.create';
        $this->url_index = 'subject.index';
        $this->url_store = 'subject.store';
        $this->url_edit = 'subject.edit';
        $this->url_update = 'subject.update';
        $this->url_show = 'subject.show';
        $this->url_destroy = 'subject.destroy';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $title_page = __("messages.subject");
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
                "label" => __("messages.subject_name"),
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

        $objects = Subject::paginate(10);
        return view("layout.template.subject.index", compact('title', 'title_page', 'url_create', 'breadcrumb', 'objects', 'dataTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $title_page = __("messages.subject");
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
                "name" => "name",
                "label" => __("messages.subject_name"),
                "type" => "input:text",
            ]
        ];

        return view("layout.template.subject.create", compact('title', 'title_page', 'url_show', 'breadcrumb', 'dataType', 'url_store', 'url_index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $add_subject = Subject::create($request->all());
        if ($add_subject) {
            return redirect()->route('subject.index')->with('success', 'Subject created successfully.');
        } else {
            return redirect()->back()->with('error', 'Subject created failed.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $object = $subject;
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
                "name" => "name",
                "label" => __("messages.subject_name"),
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

        return view("layout.template.subject.show", compact('object', 'title', 'title_page', 'url_edit', 'url_update', 'breadcrumb', 'dataType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $object = $subject;
        $title = $title_page = __("messages.subject");
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
                "name" => "name",
                "label" => __("messages.subject_name"),
                "type" => "input:text",
            ]
        ];

        return view("layout.template.subject.update", compact('object', 'title', 'title_page', 'url_update', 'breadcrumb', 'dataType', 'url_index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $update_subject = $subject->update($request->all());
        if ($update_subject) {
            return redirect()->route('subject.index')->with('success', 'Subject updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Subject updated failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $delete_subject = $subject->delete();
        if ($delete_subject) {
            return redirect()->route('subject.index')->with('success', 'Subject deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Subject deleted failed.');
        }
    }
}
