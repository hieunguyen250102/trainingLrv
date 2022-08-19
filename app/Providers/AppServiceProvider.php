<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Faculties\FacultyRepository;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\Subjects\SubjectRepository;
use App\Repositories\Subjects\SubjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\RepositoryInterface::class, BaseRepository::class);
        $this->app->bind(\App\Repositories\Faculties\FacultyRepositoryInterface::class, FacultyRepository::class);
        $this->app->bind(\App\Repositories\Subjects\SubjectRepositoryInterface::class, SubjectRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
