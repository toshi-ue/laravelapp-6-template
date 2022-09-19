<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelloRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Validator;


class HelloController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->id)) {
            $params = ['id' => $request->id];
            $items = DB::select('select * from people where id = :id', $params);
        } else {
            $items = DB::select('select * from people');
        }
        return view('hello.index', ['items' => $items]);
    }

    public function post(Request $request)
    {
        $validate_rule = [
            'msg' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $msg = $request->msg;
        $response = response()->view(
            'hello.index',
            ['msg' => '「' . $msg .
                '」をクッキーに保存しました。']
        );
        $response->cookie('msg', $msg, 100);
        return $response;
    }
}
