Как пользоваться
================

Build

```bash
$ make install
```


Use
```bash
$ make up
$ make sh
$ php ./src/index.php
```


Result
```bash
Execution time: 63.62 sec
Memory usage: 4 mb
```



Тестовое задание
================

Написать на PHP простую систему обработки клиентских заявок.

Использовать уже готовый генератор заявок: [https://github.com/vladimir163/lead-generator](https://github.com/vladimir163/lead-generator)

Необходимо обработать 10 000 заявок не дольше чем за 10 минут.

Процесс обработки одной заявки:

1.  Обработчик засыпает на 2 секунды (эмулируем тяжелую операцию)
2.  Добавляет запись в файл `log.txt` об успешной обработке в формате: `lead_id | lead_category | current_datetime`

Требования к системе:

*   Если обработка заявок определенной категории невозможна, остальные должны обрабатываться беспрепятственно.

Технические требования:

*   Объектно-ориентированный подход, интерфейсы
*   Нельзя использовать PHP-фреймворки
*   Допускается использование подключаемых библиотек.
*   Docker для запуска проекта
*   Type Hinting, PSR

Залить код в публичный Git-репозиторий.