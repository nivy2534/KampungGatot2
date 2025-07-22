<?php

namespace App\Services;

use App\Traits\ApiResponse;
use App\Repositories\Contracts\BlogRepositoryInterface;

class BlogService
{
    use ApiResponse;

    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index($request)
    {
        return $this->blogRepository->index($request);
    }
}
