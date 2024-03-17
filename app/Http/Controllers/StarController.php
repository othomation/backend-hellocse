<?php

namespace App\Http\Controllers;

use App\Models\Star;
use Illuminate\Pagination\LengthAwarePaginator;

class StarController extends Controller
{
    const PER_PAGE_DEFAULT = 10;

    public function index(): LengthAwarePaginator
    {
        return Star::paginate(static::PER_PAGE_DEFAULT);
    }
}
