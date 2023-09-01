<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\User;
use App\Policies\ClassroomPolicy;
use App\Policies\ClassworkPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Classwork::class=>ClassworkPolicy::class,
        Classroom::class=>ClassroomPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {   
      
        // Gate::before(function(User $user,$ability){
        //     if($user->super_admin){
        //         return true;
        //     }
        // });


      

      

    
    }
}
