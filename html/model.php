<?php

class author{
    private $id;

    public $fname;
    public $lname;
    public $contract;

    public function __construct($id, $fname, $lname, $contract)
    {
        $this->id = $id;
        $this->fname = $fname; 
        $this->lname = $lname;
        $this->contract = $contract; 
    }

    public function name()
    {
        return $this->fname  . ' ' . $this->lname; 
    }

    public function ID()
    {
        return $this->id; 
    }
}


?>