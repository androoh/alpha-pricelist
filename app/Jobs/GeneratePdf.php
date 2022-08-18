<?php

namespace App\Jobs;

use App\Models\PriceList;
use App\Models\PricelistProcessing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GeneratePdf implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $priceList;
    public $process;

    public $uniqueFor = 3600;

    public $pagedJsCli;
    public $apiUrl;
    public $language = 'en';
    public $cmd = "PAGEDJS_CLI 'APP_URL/api/resources/priceList/PRICELIST_ID/html?path=&template=pricelist&locale=LANGUAGE&pageSize=A4&showCropBorders=false&showCross=false&pageOrientation=portrait' -o PAGEDJS_OUTPUT_PATH/pricelist-LANGUAGE-PRICELIST_ID.pdf -t 600000 --additional-script 'PAGEDJS_HANDLERS'";

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PriceList $priceList, PricelistProcessing $process, string $language = 'en')
    {
        $this->priceList = $priceList;
        $this->process = $process;
        $this->cmd = strtr($this->cmd, [
            'PAGEDJS_CLI' => env('PAGEDJS_CLI_PATH', 'pagedjs-cli'),
            'PAGEDJS_HANDLERS' => env('PAGEDJS_CLI_HANDLERS', './'),
            'PAGEDJS_OUTPUT_PATH' => env('PAGEDJS_OUTPUT_PATH', './storage/app/pdf'),
            'APP_URL' => env('APP_URL', 'http://localhost'),
            'PRICELIST_ID' => $this->priceList->getKey(),
            'LANGUAGE' => $language
        ]);
        $this->language = $language;
    }


    /**
     * The unique ID of the job.
     *
     * @return string
     */
    public function uniqueId()
    {
        return $this->priceList->getKey() . $this->language;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process = Process::fromShellCommandline($this->cmd);
        $process->setTimeout(60000000);
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > ' . $buffer;
            } else {
                echo 'OUT > ' . $buffer;
            }
        });
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            $this->process->status = PricelistProcessing::STATUS_FAILED;
            $this->process->save();
            $this->fail();
            echo "failing";
        } else {
            $this->process->status = PricelistProcessing::STATUS_SUCCESS;
            $this->process->save();
            echo "success";
        }
        echo $process->getOutput();
    }
}
