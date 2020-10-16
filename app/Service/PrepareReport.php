<?php

namespace App\Service;

use App\Exports\ReportsExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class PrepareReport
{
    private array $toReport;
    private array $reports;

    const ALL_TO_REPORT = 'all';
    const NEWS_TO_REPORT = 'news';
    const POSTS_TO_REPORT = 'posts';
    const COMMENTS_TO_REPORT = 'comments';
    const TAGS_TO_REPORT = 'tags';
    const USERS_TO_REPORT = 'users';

    public function __construct(array $toReport)
    {
        $this->toReport = $toReport;
        $this->reports = [
            self::NEWS_TO_REPORT,
            self::POSTS_TO_REPORT,
            self::COMMENTS_TO_REPORT,
            self::TAGS_TO_REPORT,
            self::USERS_TO_REPORT
        ];
    }

    /**
     * Вызывает методы для подсчета, вызывает метод создания файла и возвразает его название
     *
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws Exception
     */
    public function getReport(): string
    {
        $report = [];

        foreach ($this->reports as $item) {
            if (!in_array(self::ALL_TO_REPORT, $this->toReport) && !in_array($item, $this->toReport)) {
                continue;
            }

            $report[0][] = $this->getColumnName($item);
            $report[1][] = $this->getCount($item);
        }

        return $this->export($report);
    }

    /**
     * Возвращает название столбца
     *
     * @param $item
     * @return string
     */
    private function getColumnName($item): string
    {
        return Lang::get('reports.' . $item);
    }

    /**
     * Создает xslx файл и возвращает его название
     *
     * @param array $data
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws Exception
     */
    private function export(array $data): string
    {
        $filename = 'report-by-' . Carbon::now()->format('d-m-Y-H:i:s') . '.xslx';
        Excel::store(new ReportsExport($data), $filename, 'reports', \Maatwebsite\Excel\Excel::XLSX);

        return $filename;
    }

    /**
     * Метод для подсчета чего-то конкретного
     * @param string $relation
     * @return int
     */
    private function getCount(string $relation): int
    {
        return DB::table($relation)->count('id');
    }
}
