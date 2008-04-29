<?php

interface Panda_Request_Interface
{
	public static function singleton($Loader = null);
	public function getMethod();
	public function getURI();
	public function getData();
}