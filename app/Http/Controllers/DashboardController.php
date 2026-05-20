<?php

namespace App\Http\Controllers;

use App\Enums\EventStatus;
use App\Enums\OrderStatus;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $eventsQuery = Event::where('user_id', $user->id);

        $stats = [
            'total_events' => (clone $eventsQuery)->count(),
            'published_events' => (clone $eventsQuery)->where('status', EventStatus::Published)->count(),
            'draft_events' => (clone $eventsQuery)->where('status', EventStatus::Draft)->count(),
            'total_orders' => Order::whereHas('event', fn ($q) => $q->where('user_id', $user->id))->count(),
            'paid_orders' => Order::whereHas('event', fn ($q) => $q->where('user_id', $user->id))
                ->where('status', OrderStatus::Paid)
                ->count(),
            'revenue' => Order::whereHas('event', fn ($q) => $q->where('user_id', $user->id))
                ->where('status', OrderStatus::Paid)
                ->sum('total'),
        ];

        $recentEvents = Event::where('user_id', $user->id)
            ->withCount(['tickets', 'orders'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentEvents'));
    }
}
