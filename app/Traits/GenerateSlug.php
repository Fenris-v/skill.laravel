<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Трейт для генерации урлов
 * Trait GenerateSlug
 * @package App\Traits
 */
trait GenerateSlug
{
    /**
     * Генерирует url,
     * проверяет его на уникальность и дописывает номера,
     * пока url не станет уникальным
     *
     * @param string $str
     * @return string
     */
    public function generateSlug(string $str): string
    {
        $slug = Str::slug($str);

        if ($this::all()->where('slug', $slug)->first()) {
            $i = 2;
            while ($this::all()->where('slug', $slug . $i)->first()) {
                $i++;
            }

            $slug .= $i;
        }

        return $slug;
    }
}
