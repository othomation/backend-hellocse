<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStarRequest;
use App\Models\Star;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use App\Traits\Validation\HandleValidatorFailure;
use App\Traits\Validation\Star\StoreStarValidationRules;
use Illuminate\Http\Response;

class StarController extends Controller
{
    use HandleValidatorFailure;
    use StoreStarValidationRules;

    const PER_PAGE_DEFAULT = 10;

    public function index(): LengthAwarePaginator
    {
        return Star::paginate(static::PER_PAGE_DEFAULT);
    }


    /**
     * @TODO Use a Request (FormRequest) validator instead of Trait
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->storeStarValidationsRules());

        $failure = $this->handleValidatorFailure($validator);
        if ($failure instanceof JsonResponse) return $failure;

        $imagePath = $request->file('image')->store('public');

        $data = [
            ...$request->only('firstname', 'lastname', 'description'),
            'image' => $imagePath
        ];

        $star = Star::create($data);

        return response()->json(
            $star,
            Response::HTTP_CREATED
        );
    }

    public function show(int $id)
    {
        return Star::where('id', $id)->get();
    }
}
