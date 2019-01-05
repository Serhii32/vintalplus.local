<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted'             => 'Ви повинні прийняти :attribute.',
    'active_url'           => 'Поле :attribute містить недійсний URL.',
    'after'                => 'В полі :attribute повинна бути дата після :date.',
    'after_or_equal'       => 'В полі :attribute повинна бути дата після або дорівнювати :date.',
    'alpha'                => 'Поле :attribute може містити тільки літери.',
    'alpha_dash'           => 'Поле :attribute може містити тільки букви, цифри, дефіс і нижнє підкреслювання.',
    'alpha_num'            => 'Поле :attribute може містити тільки букви і цифри.',
    'array'                => 'Поле :attribute має бути масивом.',
    'before'               => 'В полі :attribute повинна бути дата до :date.',
    'before_or_equal'      => 'В полі :attribute повинна бути дата до або дорівнювати :date.',
    'between'              => [
        'numeric' => 'Поле :attribute має бути між :min і :max.',
        'file'    => 'Розмір файла в полі :attribute повинен бути між :min і :max Кілобайт(а).',
        'string'  => 'Кількість символів в полі :attribute повинно бути між :min і :max.',
        'array'   => 'Кількість елементів в полі :attribute повинно бути між :min і :max.',
    ],
    'boolean'              => 'Поле :attribute повинно мати значення логічного типу.',
    'confirmed'            => 'Поле :attribute не збігається з підтвердженням.',
    'date'                 => 'Поле :attribute не є датою.',
    'date_format'          => 'Поле :attribute не відповідає формату :format.',
    'different'            => 'Поля :attribute і :other повинні відрізнятися.',
    'digits'               => 'Довжина цифрового поля :attribute повинна бути :digits.',
    'digits_between'       => 'Довжина цифрового поля :attribute повинна бути між :min і :max.',
    'dimensions'           => 'Поле :attribute имеет має неприпустимі розміри зображення.',
    'distinct'             => 'Поле :attribute містить повторюване значення.',
    'email'                => 'Поле :attribute має бути дійсним електронною адресою.',
    'exists'               => 'Вибране значення для :attribute некоректно.',
    'file'                 => 'Поле :attribute має бути файлом.',
    'filled'               => 'Поле :attribute обов\'язково для заповнення.',
    'gt' => [
        'numeric' => 'Поле :attribute має бути більше :value.',
        'file' => 'Розмір файлу в поле :attribute повинен бути більше :value Кілобайтів (а).',
        'string' => 'Кількість символів в поле :attribute має бути більше :value.',
        'array' => 'Кількість елементів в поле :attribute має бути більше :value.',
    ],
    'gte' => [
        'numeric' => 'Поле :attribute має бути більше або дорівнює :value.',
        'file' => 'Розмір файлу в поле :attribute повинен бути більше або дорівнює :value Кілобайтів (а).',
        'string' => 'Кількість символів в поле :attribute має бути більше або дорівнює :value.',
        'array' => 'Кількість елементів в поле :attribute має бути більше або дорівнює :value.',
    ],
    'image' => 'Поле :attribute має бути зображенням.',
    'in' => 'Вибране значення для :attribute помилково.',
    'in_array' => 'Поле :attribute не існує в :other.',
    'integer' => 'Поле :attribute має бути цілим числом.',
    'ip' => 'Поле :attribute має бути дійсним IP-адресою.',
    'ipv4' => 'Поле :attribute має бути дійсним IPv4-адресою.',
    'ipv6' => 'Поле :attribute має бути дійсним IPv6-адресою.',
    'json' => 'Поле :attribute має бути JSON рядком.',
    'lt' => [
        'numeric' => 'Поле: attribute має бути менше :value.',
        'file' => 'Розмір файлу в поле :attribute повинен бути менше :value Кілобайтів (а).',
        'string' => 'Кількість символів в поле :attribute має бути менше :value.',
        'array' => 'Кількість елементів в поле :attribute має бути менше :value.',
    ],
    'lte' => [
        'numeric' => 'Поле :attribute має бути менше або дорівнює :value.',
        'file' => 'Розмір файлу в полі :attribute повинен бути менше або дорівнює :value Кілобайтів (а).',
        'string' => 'Кількість символів в полі :attribute має бути менше або дорівнює :value.',
        'array' => 'Кількість елементів в полі :attribute має бути менше або дорівнює :value.',
    ],
        'max' => [
        'numeric' => 'Поле :attribute не може бути більше :max.',
        'file' => 'Розмір файлу в полі :attribute не може бути більше :max Кілобайтів (а).',
        'string' => 'Кількість символів в полі :attribute не може перевищувати :max.',
        'array' => 'Кількість елементів в полі :attribute не може перевищувати :max.',
    ],
        'mimes' => 'Поле :attribute має бути файлом одного з наступних типів: :values.',
        'mimetypes' => 'Поле :attribute має бути файлом одного з наступних типів: :values.',
        'min' => [
        'numeric' => 'Поле :attribute має бути не менше :min.',
        'file' => 'Розмір файлу в полі :attribute повинен бути не менше :min Кілобайтів (а).',
        'string' => 'Кількість символів в полі :attribute має бути не менше :min.',
        'array' => 'Кількість елементів в полі :attribute має бути не менше :min.',
    ],
    'not_in' => 'Вибране значення для :attribute помилково.',
    'not_regex' => 'Обраний формат для :attribute помилковий.',
    'numeric' => 'Поле :attribute має бути числом.',
    'present' => 'Поле :attribute має бути присутнім.',
    'regex' => 'Поле :attribute має хибний формат.',
    'required' => 'Поле :attribute обов\'язково для заповнення.',
    'required_if' => 'Поле :attribute обов\'язково для заповнення, коли :other одно :value.',
    'required_unless' => 'Поле :attribute обов\'язково для заповнення, коли :other не дорівнює :values.',
    'required_with' => 'Поле :attribute обов\'язково для заповнення, коли :values ​​вказано.',
    'required_with_all' => 'Поле :attribute обов\'язково для заповнення, коли :values ​​вказано.',
    'required_without' => 'Поле :attribute обов\'язково для заповнення, коли :values ​​не вказано.',
    'required_without_all' => 'Поле :attribute обов\'язково для заповнення, коли жодна з :values ​​не вказано.',
    'same' => 'Значення полів :attribute і :other повинні збігатися.',
    'size' => [
        'numeric' => 'Поле :attribute має бути рівним :size.',
        'file' => 'Розмір файлу в полі :attribute має дорівнювати :size Кілобайтів (а).',
        'string' => 'Кількість символів в полі :attribute має бути рівним :size.',
        'array' => 'Кількість елементів в полі :attribute має бути рівним :size.',
    ],
    'string' => 'Поле :attribute має бути рядком.',
    'timezone' => 'Поле :attribute має бути дійсним часового поясу.',
    'unique' => 'Таке значення поля :attribute вже існує.',
    'uploaded' => 'Завантаження поля :attribute не вдалася.',
    'url' => 'Поле :attribute має хибний формат.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'Ім\'я',
        'username'              => 'Нікнейм',
        'email'                 => 'E-Mail адреса',
        'first_name'            => 'Ім\'я',
        'last_name'             => 'Прізвище',
        'password'              => 'Пароль',
        'password_confirmation' => 'Підтвердження пароля',
        'city'                  => 'Місто',
        'country'               => 'Країна',
        'address'               => 'Адреса',
        'phone'                 => 'Телефон',
        'mobile'                => 'Моб. номер',
        'age'                   => 'Вік',
        'sex'                   => 'Стать',
        'gender'                => 'Стать',
        'day'                   => 'День',
        'month'                 => 'Місяць',
        'year'                  => 'Рік',
        'hour'                  => 'Година',
        'minute'                => 'Хвилина',
        'second'                => 'Секунда',
        'title'                 => 'Назва',
        'content'               => 'Контент',
        'description'           => 'Описання',
        'excerpt'               => 'Уривок',
        'date'                  => 'Дата',
        'time'                  => 'Час',
        'available'             => 'Доступно',
        'size'                  => 'Розмір',
    ],

];
