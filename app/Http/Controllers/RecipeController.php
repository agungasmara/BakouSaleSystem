<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recipe;

use App\RecipeIngredient;

use App\RecipeDirection;


class RecipeController extends Controller
{
    public function __construct()
    {
        $this-> middleware('auth:api')
            ->except('index','show');
    }

    public function index()
    {
        $recipes = Recipe::orderBy('created_at','desc')
            ->get(['name','image','id']);

        return response()
            ->json([
               'recipes' => $recipes
            ]);
    }

    public function create()
    {

        $form = Recipe::form();

        return response()
            ->json([
                'form' => $form
            ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:3000',
            'image' => 'required|image',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.name' => 'required|max:255',
            'ingredients.*.qty' => 'required|max:255',
            'directions' => 'required|array|min:1',
            'directions.*.description' => 'required|max:3000'
        ]);

        $ingredients = [];

        foreach($request->ingredients as $ingredient) {
            $ingredients[] = new RecipeIngredient($ingredient);
        }

        $directions = [];

        foreach($request->directions as $direction) {
            $directions[] = new RecipeDirection($direction);
        }

        if(!$request->hasFile('image') && !$request->file('image')->isValid()) {
            return abor(404,'Image not uploaded');
        }

        $filename = $this->getFilename($request->image);

        $request->image->move(base_path('public/image'),$filename);

        $recipe = new Recipe($request->all());

        $recipe->image = $filename;

        $request->user()
            ->recipes()->save($recipe);

        $recipe->directons()
            ->saveMany($directions);

        $recipe->ingredients()
            ->saveMany($ingredients);


        return respnose()
            ->json([
               'saved' => true,
                'id' => $recipe->id,
                'message' => 'You have successfully created recipe!'
            ]);
    }

    protected function getFilename($file)
    {

        return str_random(32). '.'.$file->extension();
    }

    public function shows($id)
    {
        $recipe = Recipe::with(['user','ingredients','directions'])
            ->findorFail($id);

        return response()
            ->json([
                'recipe' => $recipe
             ]);
    }

    public function edit($id, Request $request)
    {
        $form = $request->user()->receipes()
            ->with(['ingredients' => function($query) {
                $query->get(['id', 'description']);
            }])
            ->findorFail($id, [
                'id','name','description','image'
            ]);

        return response()
            ->json(['form' => $form]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:3000',
            'image' => 'required|image',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'integer|exists:receipe_ingredients',
            'ingredients.*.name' => 'required|max:255',
            'ingredients.*.qty' => 'required|max:255',
            'directions' => 'required|array|min:1',
            'directions.*.id' => 'integer|exists:recipe_directions',
            'directions.*.description' => 'required|max:3000'
        ]);

        $recipe = $request->user()->receipes()
            ->findorFails($id);

        $ingredients = [];

        $ingredientsUpdated = [];

        foreach($request->ingredients as $ingredient) {
            if(isset($ingredient['id'])) {
                RecipeIngredient::where('recipe_id', $recipe->id)
                    ->where('id', $ingredient['id'])
                    ->udpate($ingredient);
            } else {
                $ingredients[] = new RecipeDirection($ingredient);
            }
        }

        $directions = [];

        $directionsUpdated = [];

        foreach($request->diretions as $direction) {
            if(isset($ingredient['id'])) {
                RecipeDirection::where('recipe_id', $recipe->id)
                    ->where('id', $direction['id'])
                    ->udpate($direction);
            } else {
                $directions[] = new RecipeDirection($direction);
            }
        }


        $recipe->name = $request->name;
        $recipe->description = $request->description;

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $filename = $this->getFilename($request->image);
            $request->image->move(base_path('public/images'),$filename);

            // remove old file
            File::delete(base_path('public/images/' . $recipe->imaage));

            $recipe->image = $filename;
        }

        $recipe->save();

        // delete all ids except updated

        RecipeIngredient::whereNotIn('id', $ingredientsUpdated)
            ->where('recipe_id', $recipe->id)
            ->delete();

        RecipeDirection::whereNotIn('id', $directionsUpdated)
            ->where('recipe_id', $recipe->id)
            ->delete();

        // create new items if exists

        if(count($ingredients)) {
            $recipe->ingredients()->saveMany($ingredients);
        }

        if(count($directions)) {
            $recipe->directions->saveMany($directions);
        }

        return response()
            ->json([
               'saved' => true,
                'id' => $recipe->id,
                'message' => 'You have successfully updated recipe!'
            ]);

    }

    public function destroy($id, Request $request)
    {
        $recipe = $request->user()->recipes()
            ->findOrFail($id);

        RecipeIngredient::where('recipe_id', $recipe->id)->delete();
        RecipeDirection::where('recipe_id', $recipe->id)->delete();

        File::delete(base_path('public/images/' . $recipe->imaage));

        $recipe->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }



}
