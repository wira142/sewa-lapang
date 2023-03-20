<?php

namespace App\Traits;

trait HttpResponses
{
  protected function success($message = "", $data, $code = 200)
  {
    return response()->json(
      [
        "success" => true,
        "message" => $message,
        "data" => $data
      ],
      $code
    );
  }

  protected function error($message = "", $code = 400, $data = [])
  {
    return response()->json(
      [
        "success" => false,
        "message" => $message,
        "data" => $data
      ],
      $code
    );
  }

  protected function customMessage($exception, $alternative_message)
  {
    return config("app.debug", false) == true ? $exception->getMessage() : $alternative_message;
  }
}
