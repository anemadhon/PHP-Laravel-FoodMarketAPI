<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::query();

        $foods->when(request('search') ?? false, fn($query, $key) =>
            $query->where(fn() => 
                $query->where('name', 'like', '%'.$key.'%')
                      ->orWhere('description', 'like', '%'.$key.'%')
                      ->orWhere('type', 'like', '%'.$key.'%')
            )
        );

        return view('foods.index', [
            'foods' => $foods->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('livewire.food');
        return view('foods.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FoodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $data = $request->validated();

        if ($request->file('image_path'))
        {
            $fileName = $request->name.'_cover_'.time().'.'.$request->file('image_path')->extension();
            
            $data['image_path'] = $request->file('image_path')->storePubliclyAs('assets/foods', $fileName, 'public');
        }

        Food::create($data);

        return redirect()->route('foods.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        return view('foods.show', [
            'food' => $food
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        return view('foods.form', [
            'food' => $food
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FoodRequest  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, Food $food)
    {
        $data = $request->validated();

        if ($request->file('image_path'))
        {
            $fileName = $request->name.'_cover_'.time().'.'.$request->file('image_path')->extension();
            
            $data['image_path'] = $request->file('image_path')->storePubliclyAs('assets/foods', $fileName, 'public');
        }

        $food->update($data);

        return redirect()->route('foods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()->route('foods.index');
    }
}
