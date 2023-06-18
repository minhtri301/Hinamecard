<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\Pages\PagesRepository;
use App\Repositories\Posts\PostsRepository;
use App\Repositories\Majors\MajorsRepository;
use App\Repositories\Contacts\ContactsRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\Pages\PagesRepositoryEloquent;
use App\Repositories\Posts\PostsRepositoryEloquent;
use App\Repositories\Categories\CategoriesRepository;
use App\Repositories\Majors\MajorsRepositoryEloquent;
use App\Repositories\UserNotify\UserNotifyRepository;
use App\Repositories\Contacts\ContactsRepositoryEloquent;
use App\Repositories\Categories\CategoriesRepositoryEloquent;
use App\Repositories\UserNotify\UserNotifyRepositoryEloquent;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryEloquent;
use App\Repositories\Group\GroupRepository;
use App\Repositories\Group\GroupRepositoryEloquent;
use App\Repositories\InformationIcon\InformationIconRepository;
use App\Repositories\InformationIcon\InformationIconRepositoryEloquent;
use App\Repositories\PagesSub\PagesSubRepository;
use App\Repositories\PagesSub\PagesSubRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(CategoriesRepository::class, CategoriesRepositoryEloquent::class);
        App::bind(PagesRepository::class, PagesRepositoryEloquent::class);
        App::bind(MajorsRepository::class, MajorsRepositoryEloquent::class);
        App::bind(ContactsRepository::class, ContactsRepositoryEloquent::class);
        App::bind(PostsRepository::class, PostsRepositoryEloquent::class);
        App::bind(UserRepository::class, UserRepositoryEloquent::class);
        App::bind(UserNotifyRepository::class, UserNotifyRepositoryEloquent::class);
        App::bind(CustomerRepository::class, CustomerRepositoryEloquent::class);
        App::bind(InformationIconRepository::class, InformationIconRepositoryEloquent::class);
        App::bind(PagesSubRepository::class, PagesSubRepositoryEloquent::class);
        App::bind(GroupRepository::class, GroupRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
