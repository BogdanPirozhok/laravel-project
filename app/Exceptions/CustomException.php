<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response([
            'success' => false,
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
