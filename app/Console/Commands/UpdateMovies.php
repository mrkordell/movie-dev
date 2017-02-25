<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $movies = \App\Movie::all();
        foreach($movies as $movie){
          echo \App\Movie::updateTmdb($movie);
        }
    }
}
