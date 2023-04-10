<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\InterviewsExport;
use App\Models\Response;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('landing');
    }

    public function login()
    {
        return view('login');
    }


    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //ambil input bagian email & password
        $user = $request->only('email', 'password');
        //simpan data tersebut ke fitur auth sebagai identitas
        if (Auth::attempt($user)) {

            if (Auth::user()->role == 'admin') {
                return redirect()->route('data');
            }elseif(Auth::user()->role == 'petugas'){
                return redirect()->route('data.petugas');

            }
        }else {
            return redirect()->back()->with('eror', 'Gagal Login!');
        }
    }

    public function detailPetugas(Request $request)
    {
        $search = $request->search;
        $interviews = Interview::with('response')->orderBy('created_at', 'DESC')->get();
        return view('data_petugas', compact('interviews'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()
        ->route('login');
    }
    
    public function exportPDF() { 
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
        $data = Interview::with('response')->get()->toArray(); 
        // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
        view()->share('interviews',$data); 
        // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
        $pdf = PDF::loadView('print', $data)->setPaper('a4', 'landscape');
        // download PDF file dengan nama tertentu
        return $pdf->download('data_interview.pdf'); 
        }

    public function exportExcel()
    {
        //nama file yang akan terdownload 
        $file_name =
        'data_interview.xlsx';
        //memanggil file ReportsExport dan mendownloadnya dengan nama seperti $file name
        return Excel::download(new InterviewsExport, $file_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("data");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'age' => 'required|max:2',
            'education' => 'required',
            'phone' => 'required|numeric',
            'img' => 'required|mimes:pdf',
        ]);

         $image = $request->file('img');
         $imgName = rand() . '.' . $image->extension();
         $path = public_path('assets/image/');
         $image->move($path, $imgName);
 


        Interview::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'phone' => $request->phone,
            'education' => $request->education, 
            'img' => $imgName,
        ]);

        return redirect()->back()->with('success', 'your application has been sent!!!');
    }

    public function data(Request $request)
    {
        $search = $request->search;
        $interviews = Interview::with('response')->where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'DESC')->get();
        return view('data', compact('interviews'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //cari data yang dimaksud
        $data = Interview::where('id', $id)->firstOrFail();
        //data isinya -> nik sampe foto dari pengaduan
        //bikin variable yang isinya ngarah ke file foto terkait
        //public_path nyari file di folder public yang namnya sama kaya $data bagian foto
        $image = public_path('assets/image/'. $data['foto']);
        //uda nemu posisi fotonya , tinggal dihps fotonya pake unlink 
        unlink($image);
        //hapus $data yang isinya data nik-foto tadi, hapusnya di database
        $data->delete();
        Response::where('interview_id', $id)->delete();
        //setelahnya dikembalikan lagi kehalaman awal
        return redirect()->back();    
    }
}
