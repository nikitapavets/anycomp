<?php

namespace App\Http\Controllers;


class UploadController extends Controller
{
	public function files() {

		$fileExt = substr($_FILES['uploadfile']['name'], strpos($_FILES['uploadfile']['name'],
			'.'), strlen($_FILES['uploadfile']['name'])-1);
		$fileName = '/images/tmp/catalog_'.md5(time()).$fileExt;
		return move_uploaded_file($_FILES['uploadfile']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$fileName) ? $fileName : false;
	}
}
