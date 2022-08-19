<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Faculties\FacultyRepository;
use App\Repositories\Faculties\FacultyRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Students\StudentRepositoryInterface;
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
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
        $this->app->bind(FacultyRepositoryInterface::class, FacultyRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
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
