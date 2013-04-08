<?php

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class GroupMismatchException extends RuntimeException implements HttpExceptionInterface {

	public function getStatusCode() { return 404; }
	public function getHeaders() { return []; }

}
