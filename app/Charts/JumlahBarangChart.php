<?php

namespace App\Charts;

use App\Models\Toko;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class JumlahBarangChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $jumlahBarang = Toko::all(); // Anda mungkin perlu memodifikasi ini berdasarkan kebutuhan Anda

        $groupedBarang = $jumlahBarang->groupBy('jumlah')->map->count();

        $barang = [];
        $label = [];

        foreach ($groupedBarang as $jumlah => $count) {
            $barang[] = $jumlah;
            $label = [
                'Barang 1',
                'Barang 2',
                'Barang 3',
                'Barang 4',
                'Barang 5',
            ];
        }

        return $this->chart->donutChart()
            ->setTitle('Stok Barang')
            ->setSubtitle(date('M'))
            ->addData($barang)
            ->setLabels($label);
    }
}
