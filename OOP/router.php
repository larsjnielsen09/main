<?php

class Router
{
	private $routes = [];

	public function addRoute($method, $path, $handler)
	{
		$this->routes[] = [
			'method' => $method,
			'path' => $path,
			'handler' => $handler
		];
	}

	public function get($path, $handler)
	{
		$this->addRoute('GET', $path, $handler);
	}

	public function post($path, $handler)
	{
		$this->addRoute('POST', $path, $handler);
	}

	public function delete($path, $handler)
	{
		$this->addRoute('DELETE', $path, $handler);
	}

	public function any($path, $handler)
	{
		$this->addRoute('ANY', $path, $handler);
	}

	public function put($path, $handler)
	{
		$this->addRoute('PUT', $path, $handler);
	}

	public function handleRequest($method, $uri)
	{
		foreach ($this->routes as $route) {
			if ($route['method'] === 'ANY' || $route['method'] === $method) {
				$pattern = $this->convertRouteToRegex($route['path']);
				if (preg_match($pattern, $uri, $matches)) {
					array_shift($matches);
					// Pass matches as named parameters
					return $this->executeHandler($route['handler'], $this->extractParams($route['path'], $uri));
				}
			}
		}
		return $this->_notFound();
	}

	private function extractParams($routePath, $uri)
	{
		$routeParts = explode('/', trim($routePath, '/'));
		$uriParts = explode('/', trim($uri, '/'));
		$params = [];
		foreach ($routeParts as $index => $part) {
			if (strpos($part, '$') === 0) {
				$params[substr($part, 1)] = $uriParts[$index] ?? null;
			}
		}
		return $params;
	}

	private function convertRouteToRegex($route)
	{
		return '#^' . preg_replace('/\$([a-zA-Z0-9_]+)/', '([^/]+)', $route) . '$#';
	}

	private function executeHandler($handler, $params)
	{
		if (is_callable($handler)) {
			return call_user_func_array($handler, $params);
		} elseif (is_string($handler) && file_exists($handler)) {
			extract($params);
			require $handler;
		} else {
			throw new Exception("Invalid route handler");
		}
	}

	/**
	 * Sends a 404 Not Found response.
	 */
	private function _notFound()
	{
		http_response_code(404);
		echo "404 Not Found";
	}
}
