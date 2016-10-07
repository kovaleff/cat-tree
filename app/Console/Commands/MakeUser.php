<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Role;
use App\Permission;


class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $user = User::where('name', '=', trim($this->argument('user')))->first();
        if($user){
            $this->error('User exists!');
            return;
        }
        
        if(preg_match('/[^a-z_\-0-9]/i', $this->argument('user')))
        {
          $this->error('Only alphanumeric username allowed!');
          return;
        }        
        //$name = $this->ask('What is your name?');
        while(true)
        {
            $password = $this->secret('What is the password  (min 5  chars)?');
            if(strlen($password) < 5)
            {
              $this->error('Min length 5 chars!');
              continue;
            }
            break;
        }

        while(true)
        {
            $mail = $this->ask('What is your mail?');
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
              $this->error('wrong mail!');
              continue;
            }          
            
            $user = new User();
            $user = $user->where(['email'=>$mail])->get()->first();
            if($user){
                
              $this->error('mail exists!');
              continue;
            }

            break;
            
        }
        
        $roleStr = $this->choice('What is user\'s role ?', ['manage','admin'],0);

        $user = new User();
        $user->name = trim($this->argument('user'));
        $user->password = bcrypt($password);
        // toso - mail input
        $user->email = $mail;
        $user->save();
        
        $role = new Role();$role = $role->where(['name'=>$roleStr])->get()->first();
        $user->attachRole($role);
        $user->save();
        
        $this->info("user {$user->name} created");
        
    }
}
