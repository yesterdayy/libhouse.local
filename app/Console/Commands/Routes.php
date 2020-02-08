<?php

namespace App\Console\Commands;

use App\Models\Kladr\Kladr;
use App\Models\Realty\Realty;
use App\Models\Realty\RealtyDopType;
use App\Models\Realty\RealtyRentDuration;
use App\Models\Realty\RealtyRoomType;
use App\Models\Realty\RealtyTradeType;
use App\Models\Realty\RealtyType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class Routes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:get';

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
        Kladr::parse_slugs();
        Realty::route_cache();
    }
}
