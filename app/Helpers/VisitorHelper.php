<?php
namespace App\Helpers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorHelper
{
    public static function recordVisitor(Request $request, string $page)
    {
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');
        $oneMinuteAgo = Carbon::now()->subSeconds(60);

        $exists = Visitor::where('ip_address', $ip)
            ->where('page', $page)
            ->where('created_at', '>=', $oneMinuteAgo)
            ->exists();

        if (!$exists) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'page' => $page,
            ]);
        }
    }
}
