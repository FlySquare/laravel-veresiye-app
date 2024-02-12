<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Monthly;
use Illuminate\Http\Request;

class SlugController extends Controller
{
    public function slug(Request $request, $customerSlug)
    {
        $customer = Customers::where('slug', $customerSlug)->firstOrFail();
        $days = [];
        $sum = 0;
        $month = $request->has('ay') ? $request->ay : $customer->current_month;
        $getCurrentMonthTotalDaysCount = cal_days_in_month(CAL_GREGORIAN, $customer->current_month, date('Y'));
        for ($i = 1; $i <= $getCurrentMonthTotalDaysCount; $i++) {
            $daySlug = $i < 10 ? '0'.$i : $i;
            $todays =  Monthly::where('customer_id', $customer->hashed_id)
                ->where('created_at','>=', date('Y').'-'.$month.'-'.$daySlug.' 00:00:00')
                ->where('created_at','<=', date('Y').'-'.$month.'-'.$daySlug.' 23:59:59')
                ->get();
            $days[$i] = [
                'records' => $todays,
                'sum' => $todays->sum('total_amount'),
            ];
            $sum += $todays->sum('total_amount');
        }
        return view('customer', compact('customer', 'days', 'sum'));
    }
}
