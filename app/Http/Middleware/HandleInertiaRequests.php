<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * View principal que será carregada na primeira visita.
     */
    protected $rootView = 'app';

    /**
     * Controla a versão dos arquivos frontend.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Dados compartilhados com todas as páginas React.
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),

            'appName' => config('app.name'),
        ];
    }
}