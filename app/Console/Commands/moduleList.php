<?php

namespace App\Console\Commands;

use App\Libarary\Module\ListCommend;
use Illuminate\Console\Command;

class moduleList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modulelist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Module Lists commands';

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
        ListCommend::getList();

        $this->info('ModuleName  author         version       state');
        $this->line('Name        crazycodes       1.0           *');
        $this->line('System      crazycodes       1.0           -');
        $this->line('Business    crazycodes       1.0           *');
        $this->line('TestA       crazycodes       1.0           *');
    }
}
