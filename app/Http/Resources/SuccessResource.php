<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    /**
     * @var $message
     */
    public $message;

    /**
     * @var $data
     */
    public $data;

    /**
     * Constructor function of this class
     *
     * @param $message
     * @param $data
     */
    public function __construct($message=null, $data=null)
    {
        parent::__construct($data);
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'message' => __($this->message ?? 'Success'),
            'data' => $this->data ?? [],
        ];
    }
}
