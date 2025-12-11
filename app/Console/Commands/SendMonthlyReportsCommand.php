<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendEmployeeMonthlyReport;
use Carbon\Carbon;

class SendMonthlyReportsCommand extends Command
{
    protected $signature = 'reports:monthly';
    protected $description = 'إرسال التقارير الشهرية لكل الموظفين';

    public function handle()
    {
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        User::query()
            ->whereNotNull('email')
            ->whereNotNull('phone')
            ->chunk(100, function ($users) use ($lastMonth) {
                foreach ($users as $user) {
                    SendEmployeeMonthlyReport::dispatch($user, $lastMonth)->onQueue('reports');
                }
            });

        $this->info('تم توزيع ' . User::whereNotNull('email')->count() . ' تقرير في الـ Queue');
    }
}