<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    protected $title, $title_page, $url_create, $url_index, $url_store, $url_edit, $url_update, $url_show, $url_destroy;

    public function __construct()
    {
        $this->url_create = 'gender.create';
        $this->url_index = 'gender.index';
        $this->url_store = 'gender.store';
        $this->url_edit = 'gender.edit';
        $this->url_update = 'gender.update';
        $this->url_show = 'gender.show';
        $this->url_destroy = 'gender.destroy';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $title_page = __("messages.gender");
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
                "name" => "name",
                "label" => __("messages.gender"),
                'type' => 'input:text',
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
                    "view" => $this->url_show,
                    "edit" => $this->url_edit,
                    "delete" => $this->url_destroy,
                ]
            ]
        ];

        $objects = Gender::paginate(10);

        return view("layout.template.genders.index", compact("title_page", "title", "url_create", "breadcrumb", "dataTable", "objects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $title_page = __("messages.gender");
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
            ],
            [
                "name" => "code",
                "label" => __("messages.gender_code"),
                "type" => "input:text",
            ]
        ];
        return view("layout.template.genders.create", compact("title_page", "title", "url_show", "url_store", "url_index", "breadcrumb", "dataType"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $add_gender = Gender::create($request->all());
        if ($add_gender) {
            return redirect()->route($this->url_index)->with("success", "Gender created successfully.");
        } else {
            return redirect()->back()->with("error", "Gender created failed.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gender $gender)
    {
        $title = $title_page = __("messages.gender");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gender $gender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gender $gender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gender $gender)
    {
        //
    }
}
