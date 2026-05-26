<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterItem;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategoris.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = Kategori::query();

        if (!empty($kode)) $data_search = $data_search->where('kode','LIKE', '%'. $kode . '%');
        if (!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');

        $data_search = $data_search->select('kode', 'nama')->orderBy('id')->get();

        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);

    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $kategori = [];
        } else {
            $item = Kategori::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        $data['kategoris'] = Kategori::orderBy('id')->get();
        return view('master_items.form.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        if($method == 'new'){
            $data_item = new Kategori;
            $kode = Kategori::withTrashed()->max('id') + 1;
        } else {
            $data_item = Kategori::find($id);
            $kode = $data_item->kode;
        }
        $data_item->kode = $kode;
        $data_item->nama = $request->nama;
        $data_item->save();

        $data_item->kategori()->sync($request->kategori_ids ?? []);

        return redirect('master_items');
    }

    public function singleView($id)
    {
        $data['data'] = Kategori::with('masterItems')->find($id);
        return view('kategoris.single.index', $data);
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();

        return redirect('kategori');
    }
}
