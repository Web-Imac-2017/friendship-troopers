<?php

namespace Utils;

class RequestException extends \Exception {
  protected $message;
  protected $httpCode;

  public function __construct(string $message, int $httpCode) {
    $this->message = $message;
    $this->httpCode = $httpCode;
  }

  public function getHttpCode(): int {
    return $this->httpCode;
  }
}
