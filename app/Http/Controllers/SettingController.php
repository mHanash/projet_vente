<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Title;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $target = null;
        if($request->name=='role'){
            $options = Role::all();
            $target = 'role';
        }elseif ($request->name=='title') {
            $options = Title::all();
            $target = 'title';
        }else {
            $options = [];
        }

        return view('admin.setting',['options'=>$options,'target'=>$target]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $target = $request->target;
        if ($target=='role') {
            if (count(Role::all()->where('name',$request->name))>0) {
                return redirect()->back()->with('fail', 'On ne peut pas avoir deux rôles identiques');
            }
            if ($role = Role::create([
                'name' => $request->name
            ])) {
                return redirect()->back()->with('success', 'Option enregistrée avec succès');
            } else {
                return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enrégistrement');
            }
        }elseif($target=='title'){
            if ($title = Title::create([
                'name' => $request->name
            ])) {
                return redirect()->back()->with('success', 'Option enregistrée avec succès');
            } else {
                return redirect()->back()->with('fail', 'Une erreur est survenue lors de l\'enrégistrement');
            }
        }else{
            return redirect()->back()->with('fail', 'chemin d\'accès invalide');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $option = Title::find($request->id);
        return view('admin.setting_editor', ['option'=>$option]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $option = Title::find($request->id);
        $option->name = $request->name;
        if ($option->update()) {
            return redirect()->back()->with('success', 'option modifiée avec succès');
        }
        return redirect()->back()->with('fail', 'Une erreur est survenue lors de la modification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $target = $request->target;
        if ($target=='role') {
            $role = Role::find($request->id);
            if ($role->delete()) {
                return redirect()->back()->with('success', 'option supprimée...');
            }
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
        }elseif($target=='title'){
            $title = Title::find($request->id);
            if ($title->delete()) {
                return redirect()->back()->with('success', 'option supprimée...');
            }
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
        }else{
            return redirect()->back()->with('fail', 'Une erreur est survenue lors de la suppression');
        }
    }
}
