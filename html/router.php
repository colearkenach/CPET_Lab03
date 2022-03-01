<?php

declare ( strict_types =1 );

//namespace App;

class Router{

    private $handlers = []; 
    private $notFoundHandler; 
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET'; 

    public function get(string $path, $handler) : void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler); 

    }

    public function post(string $path, $handler) : void 
    {
        $this->addHandler(self::ETHOD_POST, $path, $handler); 
    }

    public function addNotFoundHandler($handler) :void 
    {
        $this->addNotFoundHandler = $handler; 
    }

    private function addHandler(string $method, string $path, $handler) : void
    {
        $this->handlers[$method . $path] =
        [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ]; 
    }


    public function run()
    {
        // find and execute handler for route 
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path']; 
        $method = $_SERVER['REQUEST_METHOD']; // 'POST', 'GET', etc. 

        $callback = null; 

        foreach($this->handlers as $handler)
        {
            if($handler['path'] === $requestPath && // '/about', for example 
                $method === $handler['method'])     // GET, for example 
                {
                    $callback = $handler['handler']; // method associated with path & method
                }
        }


        if(!$callback)
        {
            header("HTTP/1.1 404 Not Found", true, 404); 
            
            if(!empty($this->addNotFoundHandler)) // found custom 404 handler 
            {
                $callback = $this->addNotFoundHandler; 
            }
            else
            {
                return; 
            }
        }

        call_user_func_array($callback, 
            [
                array_merge($_GET, $_POST) // ?? 
            ]
        ); 
    }
}

?>