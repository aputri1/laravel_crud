<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Perpus;
class PerpusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpuses = Perpus::latest()->paginate(5);
        return view('perpustakaan.index',compact('perpuses'))
        ->with('i', (request()->input('page',1)-1)*5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perpustakaan.create');
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
        'judul' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'pengarang' => 'required',
        ]);
        Perpus::create($request->all());
        return redirect() -> route('perpus.index')
                          -> with('success','New Booklist successfully created');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perpus = Perpus::find($id);
        return view ('perpustakaan.detail', compact('perpus'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perpus = Perpus::find($id);
        return view ('perpustakaan.edit', compact('perpus'));
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
        $request->validate([
        'judul' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'pengarang' => 'required'
        ]);
        $perpus = Perpus::find($id);
        $perpus->judul = $request->get('judul');
        $perpus->penerbit = $request->get('penerbit');
        $perpus->tahun_terbit = $request->get('tahun_terbit');
        $perpus->pengarang = $request->get('pengarang');
        $perpus->save();
        return redirect() -> route('perpus.index')
                          -> with('success','New Booklist successfully Update');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perpus = Perpus::find($id);
        $perpus->delete();
        return redirect() -> route('perpus.index')
                          -> with('success','Booklist successfully Deleted');
    }
}