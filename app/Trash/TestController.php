<?php

namespace App\Http\Trash;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = DB::table('users')->orderBy('id')->chunk(3, function (SupportCollection $bro) {
            foreach ($bro as $key) {
                echo $key->name;
            }
        });

        return $users;

        foreach ($users as $key) {
            echo $key->name;
            echo "<br>";
        }
    }
}
