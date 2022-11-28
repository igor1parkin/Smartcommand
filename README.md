# SmartCommand



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
