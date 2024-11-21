<?php

namespace App\Service\V1;

use Illuminate\Http\Request;

class CustomerQuery{
    protected $safeParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '>=',
        'gt' => '>',
        'gte' => '>=',
    ];

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