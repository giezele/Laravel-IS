<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // JEI SU FILTRU ir searchu
        if(isset($request->menu_id) && $request->menu_id !== 0){
        // $id = \App\Models\Restaurant::where('id', $request->id)->get();
        //    dd($id[0]->menu_id);
        $menus = \App\Models\Menu::where('id', $request->menu_id)->orderBy('title')->get();
        // $menus = \App\Models\Menu::where('id', $id[0]->menu_id)->orderBy('title')->get();
        // dd($request->id);
       // dd($menus->all());
        }else if(isset($request->term) && $request->term !== Null)
        $menus = \App\Models\Menu::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('title', 'LIKE', '%'. $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        else
         $menus = \App\Models\Menu::orderBy('title')->get();

        $restaurants = \App\Models\Restaurant::orderBy('title')->get();
        

         return view('menus.index', ['restaurants' => $restaurants, 'menus' => $menus])
            ->with('i', (request()->input('page', 1) - 1) *5);

            // Jei be custom vjuso 
        // return view('menus.index', ['menus' => Menu::orderBy('title')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas ir laukai!
               'title' => 'required|unique:menus',
               'price' => 'required',
               'weight' => 'required',
               'meat' => 'required|lte:weight',
               'about' => 'required',

           ]);

        $menu = new Menu();
        // can be used for seeing the insides of the incoming request
            // dd($request->all()); die();
           $menu->fill($request->all());
        //    $menu->save();
        //    return redirect()->route('menu.index');

           return ($menu->save() !== 1) ? 
           redirect()->route('menu.index')->with('status_success', 'Menu created!') : 
           redirect()->route('menu.index')->with('status_error', 'Menu was not created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'meat' => 'required|lte:weight',
            'about' => 'required',
           ]);

         $menu->fill($request->all());

        // /JEI BE VALIDATORIAUS
        // $menu->save();
        // return redirect()->route('menu.index');

         //JEI SU VALIDATOR
         return ($menu->save() !== 1) ? 
         redirect()->route('menu.index')->with('status_success', 'Menu updated!') : 
         redirect()->route('menu.index')->with('status_error', 'Menu was not updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if (count($menu->restaurants)){ 
            return back()->withErrors(['error' => ['Can\'t delete menu with restaurants assigned, please unassign restaurants first!']]);
        }
        // else if (count($menu->customers)){ 
        //     return back()->withErrors(['error' => ['Can\'t delete country with customers assigned, please unassign customers first!']]);
        // }

        //JEI BE VALIDATORIAUS
        $menu->delete();
        return redirect()->route('menu.index')->with('status_success', 'Menu deleted!');

    }

    //kliento keliones detales rodo kokie miestai konkreciam klientui p/l id - custom view
    public function info($id){
        $menu = Menu::find($id);
        $restaurants = \App\Models\Restaurant::where('menu_id', $id)->orderBy('title')->get();

        return view('menus.info', ['menu' => $menu, 'restaurants' => $restaurants]);
    }
}
