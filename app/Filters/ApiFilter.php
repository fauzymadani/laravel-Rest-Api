<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter{
    protected $safeParms = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request) {
        $eloQuery = [];
    
        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);
    
            if (!isset($query)) {
                continue; // continue if the params  empty
            }
    
            $column = $this->columnMap[$parm] ?? $parm;
    
            foreach ($operators as $operator) {
                // check for operator
                if (isset($query[$operator]) && isset($this->operatorMap[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
    
        return $eloQuery;
    }
    
}