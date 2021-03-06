<?php


namespace App\Repositories\Category\Exceptions;


use Exception;
use Throwable;

class WrongParentChildModelRelation extends Exception
{
    public function __construct($message = "Error", $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        return response()->json([
            'error' => $this->getMessage()
        ],  $this->code);
    }
}