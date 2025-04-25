<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Regulation;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('عدد طلبات الخدمة'), Order::count())
            ->description(__('طلبات اليوم'))
            ->icon('icon-orders')
            ->color('info'),

        Stat::make(__('عدد المقالات'), Blog::count())
            ->description(__('تمت إضافتها'))
            ->icon('icon-blogger')
            ->color('success'),

        Stat::make(__('عدد الخدمات'), Service::count())
            ->description(__('الخدمات المتوفرة'))
            ->icon('icon-service')
            ->color('primary'),

        Stat::make(__('عدد المشاريع'), Project::count())
            ->description(__('المشاريع المنجزة'))
            ->icon('icon-project')
            ->color('warning'),

        Stat::make(__('عدد التصنيفات'), Category::count())
            ->description(__('التصنيفات الفعالة'))
            ->icon('icon-category')
            ->color('gray'),

        Stat::make(__('عدد اللوائح والتنظيمات'), Regulation::count())
            ->description(__('قوانين حالية'))
            ->icon('icon-policy')
            ->color('purple'),

        Stat::make(__('عدد الشركاء'), Partner::count())
            ->description(__('شركاء النجاح'))
            ->icon('icon-partner')
            ->color('teal'),

        Stat::make(__('عدد العملاء'), Customer::count())
            ->description(__('فريق العمل'))
            ->icon('icon-customer')
            ->color('rose'),
        ];
    }
}
