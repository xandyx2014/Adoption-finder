<?php

namespace App\Jobs;

use App\Models\Bitacora;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BitacoraJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $accion;
    private $entidad;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($accion , $entidad)
    {
        $this->accion = $accion;
        $this->entidad = $entidad;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Bitacora::create([
            'accion' => $this->accion,
            'entidad' => $this->entidad,
            'user_id' => auth()->user()->id,
        ]);
    }
}
