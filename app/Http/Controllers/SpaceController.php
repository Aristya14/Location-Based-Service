<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menampilkan data dari tabel space
        // return view('space.index');
        $data = Space::all();
        return view('space.list', [
            'data' => $data,
            'title' => "My Places",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Memanggil model CentrePoint untuk mendapatkan data yang akan dikirimkan ke form create
        // space
        $centrepoint = CentrePoint::get()->first();
        return view('space.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lakukan validasi data
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'slug' => 'required',
            'street' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'location' => 'required'
        ]);

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $spaces = new Space;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/uploads', $imageName);
        }

        // Memasukkan nilai untuk masing-masing field pada tabel space berdasarkan inputan dari
        // form create 
        $spaces->image = $imageName;
        $spaces->name = $request->input('name');
        $spaces->slug = Str::slug($request->name, '-');
        $spaces->location = $request->input('location');
        $spaces->street = $request->input('street');
        $spaces->content = $request->input('content');

        //return dd($spaces);

        // proses simpan data
        $spaces->save();

        // redirect ke halaman index space
        if ($spaces) {
            return redirect()->route('space.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('spaceI.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $centrePoint = CentrePoint::get()->first();
        // $spaces = Space::where('slug', $slug)->first();
        // return view('detail', [
        //     // 'centrePoint' => $centrePoint,
        //     'spaces' => $spaces
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Space $space)
    {
        // mencari data space yang dipilih berdasarkan id
        // kemudian menampilkan data tersebut ke form edit space
        $space = Space::findOrFail($space->id);
        return view('space.edit', [
            'space' => $space
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Space $space)
    {
        // Menjalankan validasi
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'location' => 'required'
        ]);

        // Jika data yang akan diganti ada pada tabel space
        // cek terlebih dahulu apakah akan mengganti gambar atau tidak
        // jika gambar diganti hapus terlebuh dahulu gambar lama
        $space = Space::findOrFail($space->id);
        if ($request->hasFile('image')) {
            if (File::exists("storage/uploads" . $space->image)) {
                File::delete("storage/uploads" . $space->image);
            }
            $file = $request->file("image");
            $space->image = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/uploads', $space->image);
            $request['image'] = $space->image;
        }

        // Lakukan Proses update data ke tabel space
        $space->update([
            'name' => $request->name,
            'location' => $request->location,
            'content' => $request->content,
            'slug' => Str::slug($request->name, '-'),
        ]);

        // redirect ke halaman index space
        if ($space) {
            return redirect()->route('space.index')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('space.index')->with('error', 'Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus keseluruhan data pada tabel space begitu juga dengan gambar yang disimpan
        $space = Space::findOrFail($id);
        $space->delete();
        if ($space->image) {
            File::delete("storage/uploads/" . $space->image);
        }


        // $space = Space::findOrFail($id);
        // $space->delete();
        // if($space->gambar){
        //     Storage::delete($space->image);
        // }
        return redirect()->route('map.index')->with('hapus_produk', 'Produk Telah Dihapus');;
    }
}
