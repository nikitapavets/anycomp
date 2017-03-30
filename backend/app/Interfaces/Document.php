<?php

namespace App\Interfaces;

interface Document
{
	public function create($fileInfo, $orgInfo, $productInfo);
}