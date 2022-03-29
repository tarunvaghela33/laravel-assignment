<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\File;

class Utility
	{

	/**
	 * @param array $input
	 *
	 * @return string
	 */
	public static function fileUpload(Object $input, $uploadPath, $fileName = null, $oldFile = null) {
		if ($fileName == 'original') {
			$name = $input->getClientOriginalName();
		}else if ($fileName) {
			$name = $fileName. '.' . $input->getClientOriginalExtension();
		}else{
			$name = $input->hashName();
		}
		$destinationPath = public_path($uploadPath);
		$input->move($destinationPath, $name);

		if ($oldFile) {
			File::delete(public_path($oldFile));
		}

		return $uploadPath.$name;
	}
}
