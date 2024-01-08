<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Models\FsiRoute;
class FsiRouteGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fsi_route:generate';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';
 
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        
        //ob_start();
        //$this->call('route:list', ['--json'=>true, '-q'=> true]);
        Artisan::call('route:list', ['--json'=>true]);
        $jsonData = Artisan::output();
        FsiRoute::truncate();
        foreach(json_decode($jsonData) as $route){
            $data = (array)$route;
            $middlewares = ['', 'web', 'api'];
            if(array_intersect($data['middleware'], $middlewares)){
                $data['url'] = $data['uri'];
                list($data['method'],) = explode("|", $data['method']);
                if(stristr($data['action'], "@")){
                    list($data['action_class'], $data['action_method']) = explode("@", $data['action']);
                }
                else {
                    $data['action_method'] = " ";
                    $data['action_class'] = $data['action'];
                }

                $data['middleware'] = $data['middleware'][0];
                FsiRoute::create($data);
            }
        }

    }

    public function doComment($text, $overrideDebug = false)
    {
            $this->comment($text);
    }
}