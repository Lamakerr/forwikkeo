<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Test;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Yajra\DataTables\DataTables;


class TableController extends Controller
{



    public function index(Request $request)
    {
        $students  = getJsonObject()->students;
        $startIndex = 0;
        if ($request->ajax()) {
            $allData = DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' .
                        $row->id . '"data-original-title="Edit" class="edit btn btn-secondary  editStudent">Изменить</a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' .
                        $row->id . '"data-original-title="Delete" class="delete btn btn-danger ms-2  deleteStudent">Удалить</a>';
                    return $btn;
                })
                ->rawColumns(["action"])
                ->make(true);
            return $allData;
        }
        return view('index', compact('students'));
    }

    public function delete($id)
    {
        $all  = getJsonObject();
        $id = array_search($id, array_column($all->students, "id"));
        unset($all->students[$id]);
        $all->students = array_values($all->students);
        file_put_contents(storage_path() . "/json/table.json", json_encode($all));

        return response()->json(['success' => "Студент удален"]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $students  = getJsonObject();
        $studentLast = array_key_last($students->students);

        if ($request->id !== null) {
            $id = array_search($request->id, array_column($students->students, "id"));
            unset($students->students[$id]);
            $data['id'] = $id;
            $students->students = array_values($students->students);
            array_push($students->students, $data);
            file_put_contents(storage_path() . "/json/table.json", json_encode($students));

            return response()->json(['success' => 'Студент успешно добавлен']);
        }
       
        if ($studentLast === null) {
            $data['id'] = 0;
            $students->students = array_values($students->students);
            array_push($students->students, $data);
            file_put_contents(storage_path() . "/json/table.json", json_encode($students));

            return response()->json(['success' => 'Студент успешно добавлен']);
        } else {

            $studentLast = end($students->students)->id;

            $data['id'] = $studentLast + 1;
            $students->students = array_values($students->students);
            array_push($students->students, $data);
            file_put_contents(storage_path() . "/json/table.json", json_encode($students));

            return response()->json(['success' => 'Студент успешно добавлен']);
        }
    }

    public function edit($id)
    {

        $students = getJsonObject();
        return response()->json($students->students[$id]);
    }
}
