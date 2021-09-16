<?php
if (!function_exists('slug')) {
    function slug(string $value, string $locale = null): string
    {
        $sets = [
            'uk' => [
                'А' => 'A',
                'а' => 'a',
                'Б' => 'B',
                'б' => 'b',
                'В' => 'V',
                'в' => 'v',
                'Г' => 'H',
                'г' => 'h',
                'Ґ' => 'G',
                'ґ' => 'g',
                'Д' => 'D',
                'д' => 'd',
                'Е' => 'E',
                'е' => 'e',
                'Є' => 'Ye',
                'є' => 'ye',
                'Ж' => 'J',
                'ж' => 'j',
                'З' => 'Z',
                'з' => 'z',
                'І' => 'I',
                'і' => 'i',
                'Ї' => 'Yi',
                'ї' => 'yi',
                'И' => 'Y',
                'и' => 'y',
                'Й' => 'Y',
                'й' => 'y',
                'К' => 'K',
                'к' => 'k',
                'Л' => 'L',
                'л' => 'l',
                'М' => 'M',
                'м' => 'm',
                'Н' => 'N',
                'н' => 'n',
                'О' => 'O',
                'о' => 'o',
                'П' => 'P',
                'п' => 'p',
                'Р' => 'R',
                'р' => 'r',
                'С' => 'S',
                'с' => 's',
                'Т' => 'T',
                'т' => 't',
                'У' => 'U',
                'у' => 'u',
                'Ф' => 'F',
                'ф' => 'f',
                'Х' => 'H',
                'х' => 'h',
                'Ц' => 'Ts',
                'ц' => 'ts',
                'Ч' => 'Ch',
                'ч' => 'ch',
                'Ш' => 'Sh',
                'ш' => 'sh',
                'Щ' => 'Shch',
                'щ' => 'shch',
                'Ю' => 'Yu',
                'ю' => 'yu',
                'Я' => 'Ya',
                'я' => 'ya',
            ],
            'ru' => [
                'А' => 'A',
                'а' => 'a',
                'Б' => 'B',
                'б' => 'b',
                'В' => 'V',
                'в' => 'v',
                'Г' => 'G',
                'г' => 'g',
                'Д' => 'D',
                'д' => 'd',
                'Е' => 'E',
                'е' => 'e',
                'Ё' => 'Yo',
                'ё' => 'yo',
                'Ж' => 'J',
                'ж' => 'j',
                'З' => 'Z',
                'з' => 'z',
                'И' => 'I',
                'и' => 'i',
                'Й' => 'Y',
                'й' => 'y',
                'К' => 'K',
                'к' => 'k',
                'Л' => 'L',
                'л' => 'l',
                'М' => 'M',
                'м' => 'm',
                'Н' => 'N',
                'н' => 'n',
                'О' => 'O',
                'о' => 'o',
                'П' => 'P',
                'п' => 'p',
                'Р' => 'R',
                'р' => 'r',
                'С' => 'S',
                'с' => 's',
                'Т' => 'T',
                'т' => 't',
                'У' => 'U',
                'у' => 'u',
                'Ф' => 'F',
                'ф' => 'f',
                'Х' => 'H',
                'х' => 'h',
                'Ц' => 'Ts',
                'ц' => 'ts',
                'Ч' => 'Ch',
                'ч' => 'ch',
                'Ш' => 'Sh',
                'ш' => 'sh',
                'Щ' => 'Sch',
                'щ' => 'sch',
                'Ы' => 'Y',
                'ы' => 'y',
                'Э' => 'E',
                'э' => 'e',
                'Ю' => 'Yu',
                'ю' => 'yu',
                'Я' => 'Ya',
                'я' => 'ya',
            ],
        ];
        return \Illuminate\Support\Str::slug(optional($locale ?? app()->getLocale(), function (string $locale) use ($sets, $value) {
                return optional($sets[$locale] ?? null, function (array $set) use ($value) {
                    return str_replace(array_keys($set), array_values($set), $value);
                });
            }) ?? $value);
    }
}