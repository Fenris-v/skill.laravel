<?php

namespace App\Service;

use App\Events\ReportRequested;
use App\Exports\ReportsExport;
use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class PrepareReport
{
    private array $toReport;

    const ALL_TO_REPORT = 'all';
    const NEWS_TO_REPORT = 'news';
    const POSTS_TO_REPORT = 'posts';
    const COMMENTS_TO_REPORT = 'comments';
    const TAGS_TO_REPORT = 'tags';
    const USERS_TO_REPORT = 'users';

    public function __construct(array $toReport)
    {
        $this->toReport = $toReport;
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

        if (in_array(self::ALL_TO_REPORT, $this->toReport)) {
            $report = $this->allCount();
        } else {
            foreach ($this->toReport as $item) {
                $report[0][] = $this->getColumnName($item);
                $report[1][] = $this->getCount($item);
            }
        }

//        $filename = $this->export($report);

//        event(new ReportRequested(auth()->user()));

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
        switch ($item) {
            case self::NEWS_TO_REPORT:
                return 'Новости';
            case self::POSTS_TO_REPORT:
                return 'Статьи';
            case self::COMMENTS_TO_REPORT:
                return 'Комментарии';
            case self::TAGS_TO_REPORT:
                return 'Теги';
            case self::USERS_TO_REPORT:
                return 'Пользователи';
            default:
                return 'Неизвестно';
        }
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

    /**
     * Метод для подсчета всего
     * @return array
     */
    private function allCount(): array
    {
        $report[] = [
            'Новости',
            'Статьи',
            'Комментарии',
            'Теги',
            'Пользователи'
        ];
        $report[] = [
            News::count('id'),
            Post::count('id'),
            Comment::count('id'),
            Tag::count('id'),
            User::count('id')
        ];

        return $report;
    }
}
