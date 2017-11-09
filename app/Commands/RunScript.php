<?php
namespace App\Commands;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
/**
 * This is a custom command for executing scripts from or with respect of root folder.
 * The script should be self executing.
 */
class RunScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:script {filename : path/filename.php of script to run relative to project root}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a script';
    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
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
        // include the script file to run
        require($this->argument('filename'));
    }
}