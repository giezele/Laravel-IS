<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
         //JEI BE FILTRO SITAS INDEX
    // public function index()
    // {
    //     return view('restaurants.index', ['restaurants' => Restaurant::orderBy('title')->get()]);
    // }

    // JEI SU FILTRU 
    public function index(Request $request)
    {
        if(isset($request->menu_id) && $request->menu_id !== 0){
        $restaurants = \App\Models\Restaurant::where('menu_id', $request->menu_id)->orderBy('title')->get();
        // dd($request->menu_id);
        // dd($restaurants->all());
        }else if(isset($request->term) && $request->term !== Null)
        $restaurants = \App\Models\Restaurant::where([
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
        $restaurants = \App\Models\Restaurant::orderBy('title')->get();

        $menus = \App\Models\Menu::orderBy('title')->get();
    return view('restaurants.index', ['restaurants' => $restaurants, 'menus' => $menus]);
    }

        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = \App\Models\Menu::orderBy('title')->get();
        return view('restaurants.create', ['menus' => $menus]);

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
               'title' => 'required', //ar tikrai reikia buti unique?
               'customers' => 'required',
               'employees' => 'required',
               'menu_id' => 'required',
           ]);

        $restaurant = new Restaurant();
        // can be used for seeing the insides of the incoming request
        // var_dump($request->all()); die();
        $restaurant->fill($request->all());
        // $restaurant->save();
        // return redirect()->route('restaurant.index');

        return ($restaurant->save() !== 1) ? 
        redirect()->route('restaurant.index')->with('status_success', 'Restaurant created!') : 
        redirect()->route('restaurant.index')->with('status_error', 'Restaurant was not created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
         // ATTENTION :: we need countries to be able to assign them
         $menus = \App\Models\Menu::orderBy('title')->get();
         return view('restaurants.edit', ['restaurant' => $restaurant, 'menus' => $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas ir laukai!
            'title' => 'required', //ar tikrai reikia buti unique?
            'customers' => 'required',
            'employees' => 'required',
            'menu_id' => 'required',
           ]);

        $restaurant->fill($request->all());
        // $restaurant->save();
        // return redirect()->route('restaurant.index');

        return ($restaurant->save() !== 1) ? 
        redirect()->route('restaurant.index')->with('status_success', 'Restaurant updated!') : 
        redirect()->route('restaurant.index')->with('status_error', 'Restaurant was not updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurant.index')->with('status_success', 'restaurant deleted!');
    }

    //restorano  detales rodo kokie menu konkreciam restoranui p/l id - custom view
    public function details($id){
        $restaurant = \App\Models\Restaurant::find($id);
        return view('restaurants.details', ['restaurant' => $restaurant]);
    }
}
