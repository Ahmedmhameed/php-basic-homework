<?php
namespace App\Traits;
trait Timestampable
{
    private string $createdAt;

    private function initTimestamps(): void
    {
        $this->createdAt = date('Y-m-d H:i:s');
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}