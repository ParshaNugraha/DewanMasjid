<?php

return [
    'role' => \App\Http\Middleware\CheckRole::class,
    'masjid.owner' => \App\Http\Middleware\CheckMasjidOwnership::class,
];
