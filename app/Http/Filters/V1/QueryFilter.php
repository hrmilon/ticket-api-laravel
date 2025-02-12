<?php

namespace App\Http\Filters\V1;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{
    protected $sortable = [];
    protected $builder;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    //internal function for resolving function to filter()
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key))
                $this->$key($value); //filter["status" => "C"]
        }

        return $builder;
    }

    //endpoint ?filter[status]=text   
    //by default called this method from controller
    protected function filter($arr)
    {
        foreach ($arr as $key => $value) {
            if (method_exists($this, $key))
                $this->$key($value);
        }

        return $this->builder;
    }


    //endpoint ?sort=name,-title
    public function sort($value)
    {
        $sortAttributes = explode(',', $value);
        foreach ($sortAttributes as $sortAttribute) {
            $direction = 'asc'; //default
            if (strpos($sortAttribute, '-') === 0) {
                $direction = 'desc';
                $sortAttribute = substr($sortAttribute, 1);
            }

            if (!in_array($sortAttribute, $this->sortable) && ! array_key_exists($sortAttribute, $this->sortable)) {
                continue;
            }

            $columnName = $this->sortable[$sortAttribute] ?? null;

            if ($columnName === null) {
                $columnName = $sortAttribute;
            }

            $this->builder->orderBy($columnName, $direction);
        }
    }
}
