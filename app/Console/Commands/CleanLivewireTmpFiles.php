<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CleanLivewireTmpFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:livewire-tmp';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $livewireTmpPath = storage_path('app/livewire-tmp');
        $files = File::allFiles($livewireTmpPath);
        $now = Carbon::now();

        foreach ($files as $file) {
            $modifiedAt = $file->getMTime();
            $modifiedDateTime = Carbon::createFromTimestamp($modifiedAt);

            if ($modifiedDateTime->diffInHours($now, false) >= 24) {
                File::delete($file->getPathname());
            }
        }

        $this->info('Temporary files in livewire-tmp cleaned up successfully.');
    }
}
