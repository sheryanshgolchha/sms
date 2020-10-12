<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class date extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'display:date';

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
     * @return int
     */
    public function handle()
    {
        if(date("d")<15)
            $this->line("First Half of the Month");
        else if(date("d")==15)
            $this->line("Mid of the Month");
        else
            $this->line("Second half of the Month");
    }
}
