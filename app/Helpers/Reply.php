<?php

namespace App\Helpers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Reply {
	/** Return success response
	 * @param $message
	 * @return array
	 */
	public static function success($message) {
		return [
			"status" => "success",
			"message" => $message
		];
	}

	/** Return success response
	 * @param $message
	 * @param $data
	 * @return array
	 */
	public static function successWithData($message, $data) {
		$response = Reply::success($message);

		return array_merge($response, $data);
	}

	/** Return error response
	 * @param $message
	 * @return array
	 */
	public static function error($message, $error_name = null, $errorData = []) {
		return [
			"status" => "fail",
			"error_name" => $error_name,
			"data" => $errorData,
			"message" => $message
		];
	}

	/** Return validation errors
	 * @param \Illuminate\Validation\Validator|Validator $validator
	 * @return array
	 */
	public static function formErrors($validator) {
		return [
			"status" => "fail",
			"errors" => $validator->getMessageBag()->toArray()
		];
	}

	/** Response with redirect action. This is meant for ajax responses and is not meant for direct redirecting
	 * to the page
	 * @param $url string to redirect to
	 * @param null $message Optional message
	 * @return array
	 */
	public static function redirect($url, $message = null) {
		if ($message) {
			Session::flash('success', $message);
			return [
				"status" => "success",
				"message" => $message,
				"action" => "redirect",
				"url" => $url
			];
		}
		else {
			return [
				"status" => "success",
				"action" => "redirect",
				"url" => $url
			];
		}
	}

	public static function dataOnly($data) {
		return $data;
	}
}
