<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('create');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        // 同じタグがあるか確認
        $exist_tag = Tag::where('name', $data['tag']) -> where('user_id', $data['user_id'])->first();
        if( empty($exist_tag['id']) === true){
        // 先にタグをインサート
            $tag_id = Tag::insertGetId(['name' => $data['tag'], 'user_id' => $data['user_id'] ]);
        }else{
            $tag_id = $exist_tag['id'];
        }
        // dd($is_exist);

        $memo_id = Memo::insertGetId([
            'content_name' => $data['content_name'], 'content' => $data['content'], 'user_id' => $data['user_id'], 'tag_id' => $tag_id, 'status' => 1
        ]);

        return redirect()->route('home');
    }

    public function edit($id){
        $user = \Auth::user();
        // 該当するIDのメモをデータベースから取得
        $memo = Memo::where('status', 1)->where('id', $id)->where('user_id', $user['id'])
          ->first();
        return view('edit',compact('memo'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        // ここのwhereは重要！
        Memo::where('id', $id)->update(['content_name' => $inputs['content_name'], 'content' => $inputs['content'], 'tag_id' => $inputs['tag_id'] ] );
        return redirect()->route('home');
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        // ここのwhereは重要！
        // 論理削除モデルなのでstats => 2
        Memo::where('id', $id)->update([ 'status' => 2] );

        return redirect()->route('home')->with('success', 'メモの削除が完了しました！');
    }
}
