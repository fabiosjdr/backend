<?php

namespace Fabio\Bibliotecas\SearchEngine;

use Illuminate\Support\Facades\DB;
use Fabio\Bibliotecas\Util\Facade;

class SearchEngine extends Facade
{   
    private $query;
    private $alias;
    private $model;

    public function __construct($Model) {
        $this->alias = '';
        $this->model = $Model;
        $this->query = $Model->query();
    }

    public function setAlias($alias){

        $this->alias = $alias;
        $table = $this->model->getTable();
        $this->setTable($table . ' as '.$alias);
        //$this->query  = DB::table($table . ' as '.$alias);
    }

    public function setTable($table){
        $this->query  = DB::table($table);
    }

    public function run(){
        return $this->query->get();
    }

    public function getQuery(){
        return $this->query;
    }

    public function getSql(){
        return $this->query->toSql();
    }

    private function extractQueryParameters(array $completeQuery): array
    {
        $queryParameters = ['fields', 'sort', 'offset', 'limit'];
        $filters = $others = [];
        foreach ($completeQuery as $column => $value) {
            if (in_array($column, $queryParameters)) {
                $others[$column] = $value;
            } else {
                $filters[$column] = $value;
            }
        }

        return [$filters, $others];
    }

    private function extractStringValues(string $value): array
    {
        $separators = [',', ', '];
        $value = str_replace($separators, $separators[0], $value);
        //$alias = ($this->alias != '') ? $this->alias.'.' : '';

        return explode($separators[0], $value);
    }

    public function setJoin($table,$field1,$operator,$field2){
        $this->query->join($table, $field1, $operator, $field2);
    }

    public function setLeftJoin($table,$field1,$operator,$field2){
        $this->query->LeftJoin($table, $field1, $operator, $field2);
    }
    
    public function setSelect($sql){
        $this->query->select(DB::raw($sql));
    }

    public function toSql(){
        return $this->query->toSql();
    }

    public function build(array $parameters)
    {
        //$this->query = $this->model->query();

        list($filters, $others) = $this->extractQueryParameters($parameters);

        if (!empty($filters)) {

            foreach ($filters as $column => $value) {
                
                if (is_array($value)) {

                    if( isset( array_values($value)[2]) ){
                        $column =  array_values($value)[2].'.'.$column;
                    }else if($this->alias != ''){
                        $column =  $this->alias.'.'.$column;
                    }

                    $operator = array_values($value)[0];
                    $value    = array_values($value)[1];

                    if ($operator == '*' || $operator == '**') {
                        $value .= '%';
                        if ($operator === '**') $value = '%' . $value;
                        $operator = 'like';
                    }

                } else {

                    if($this->alias != ''){
                        $column =  $this->alias.'.'.$column;
                    }
                    
                    $operator = '=';
                }

                

              
                $this->query->where($column, $operator, $value);
              
               
            }
        }

        if (!empty($others)) {

            if (isset($others['fields'])) {
                $this->query->select($this->extractStringValues($others['fields']));
            }

            if (isset($others['sort'])) {
                foreach ($this->extractStringValues($others['sort']) as $sort) {
                    // TIP: COLUNA1.desc,COLUNA2.asc,COLUNA3.desc
                    if (strpos($sort, '.') !== false) $sort = explode('.', $sort);
                    // TIP: desc(COLUNA1),asc(COLUNA2),desc(COLUNA3)
                    else $sort = array_reverse(explode('(', explode(')', $sort)[0]));

                    $this->query->orderBy($sort[0], $sort[1]);
                }
            }
            
            if (isset($others['offset'])) $this->query->offset($others['offset']);

            if (isset($others['limit'])) $this->query->limit($others['limit']);
            else $this->query->limit(10);
            
        }
        
        //return $this->query ;
    }
}
