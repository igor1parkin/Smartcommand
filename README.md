# SmartCommand



## Проблема с композером 
Видимо где-то допустил ошибку и библиотека перестала адекватно прикручиваться к example.php - если не успею попровавить прошу скачать и распоковать файл version_without_compose.zip для проверки работоспособности 

Непосредственно файлы библиотеки расположены в папке ```src```

## Запуск команды 
```javascript
php example.php command_name {verbose,overwrite} [log_file=app.log] {unlimited} [methods={create,update,delete}] [paginate=50] {log}
```

## Вывод help'a команды
```javascript
php example.php command_name {help}
```

## Вывод команд
```javascript
php example.php
```

## Problem with parsing
```javascript
* Костыль т.к. возникла проблема с парсингом агрумента {arg1,arg2} 
* - массив $argv возвращает как ['arg1', 'arg2']
* а {arg1, arg2} как ['{arg1', 'arg2}'] 
* - это какие-то проблемы с моим оружением или нюанс задачи?
*/
public function parseArguments(): array
{
    $args = $_SERVER['argv'];
    $arguments = [];
    for ($i = 2; $i <= count($args) - 1; $i++) {
        if ($this->isNotOption($args[$i])) {
            $arguments[] = preg_replace('#[{}]+#', '', $args[$i]);
        }
    }

    return $arguments;
}
```


## License
MIT
