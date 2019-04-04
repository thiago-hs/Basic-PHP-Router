<?php  

class Router {
    
	private $request;
	private $supportedHttpMethod = array(
		"GET",
		"POST"
	);

	function __construct(IRequest $request)
	{
		$this->request = $request;
	}
	
	function __call($name,$args)
	{
		list($route,$method) = $args;
		
		if(!in_array(strtoupper($name),$this->supportedHttpMethod))
		{
			$this->invalidMethodHandler();
		}
		
		$this->{strtolower($name)}[$this->formatRoute($route)] = $method ;
	}
	
	private function formatRoute($route)
	{
		$result = rtrim($route,'/');
		
		if($result == '')
		{
			return '/';
		}
		
		return $result ;
	}
	
	private function invalidMethodHandler(){
		
		header("{$this->request->serverProtocol} 405 Method Not Allowed");
	
	}
	
	private function defaultRequestHandler(){
		
		echo "Error 404 {$this->formatRoute($this->request->requestUri)} Not Found";
	    header("{$this->request->serverProtocol} 404 Not Found");

	}
	
	function resolve()
	{
		
    	$methodDictionary = $this->{strtolower($this->request->requestMethod)};
    	$formatedRoute = $this->formatRoute($this->request->requestUri);
    	$method = $methodDictionary[$formatedRoute];

		if(is_null($method)){
			$this->defaultRequestHandler();
			return;	
		}
		
		echo call_user_func_array($method,array($this-request));
	}
	
	function __destruct()
	{
		$this->resolve();
	}
}
