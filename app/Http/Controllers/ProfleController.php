<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfleController extends Controller
{
    public function profile()
    {
        $profile = User::find(1);

        return view('page.profile.index', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $olg_img = public_path('upload/profile/' . $request->olg_image); // Path ke file gambar lama

        if ($request->file('poto')) {
            // Cek apakah gambar lama ada dan bukan direktori
            if (is_file($olg_img) && file_exists($olg_img)) {
                unlink($olg_img); // Menghapus file gambar lama
            }
            $image = $request->file('poto');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Membuat nama file unik
            $image->move(public_path('upload/profile'), $imageName);

            User::findOrFail(auth()->user()->id)->update([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'poto' => $imageName
            ]);
            Alert::toast('Berhasil Mengubah Profile', 'success');
            return redirect()->back();
        } else {
            User::findOrFail(auth()->user()->id)->update([
                'name' => $request->name,
            ]);
            Alert::toast('Berhasil Mengubah Profile', 'success');
            return redirect()->back();
        }
    }
}
