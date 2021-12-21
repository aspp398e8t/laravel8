<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $facilities = Facility::orderBy('title', 'asc')->get();

        return view('admin.facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = Storage::put('/', $request->image_url);

        Facility::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $path
        ]);

        return redirect()->route('facility.index');
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
        $facility = Facility::find($id);
        return view('admin.facility.edit', compact('facility'));
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
        $facility = Facility::find($id);
        if ($request->hasFile('image_url')) {
            // 刪除圖片
            Storage::delete($facility->image_url);
            // 儲存新圖片
            $path = Storage::put('/', $request->image_url);
        } else {
            $path = $facility->image_url;
        }
        $facility->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $path
        ]);
        return redirect()->route('facility.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facility = Facility::find($id);
        Storage::delete($facility->image_url);
        $facility->delete();
        return redirect()->route('facility.index');
    }
}
