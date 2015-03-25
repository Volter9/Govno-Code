# Говнокод

Мой старый код из 2011-2013 год. Тут можно найти много всего интересного, типа этого:
```php
public function get($name = "%all%") {
	if($name == "%all%") {
		return $this->vars;
	}
	else {
		return $this->vars[$name];
	}
}
```
Или вот это:
```php
function isURL($url) {
	if(preg_match("/(http:\/\/|https:\/\/|ftp:\/\/)([a-zA-Z0-9\.\-]{1,253})\/([a-zA-Z0-9\-\.\?\$\_\+\!\*'\(\),]*)/i",$url)) {
		return true;
	}
	else {
		return false;
	}
}
```
А теперь более подробнее о каждой папочки (ой как я люблю подробности :smirk: ).

*Disclaimer:*

Не пытайтесь повторить это дома!

## Downloader+ (`downloaderPlus/`)

Класс для скачивания файлов определенного расширения (через метод `setFileExtension`) на веб странице (создан наряду с GPLGenerator). Пример в файле `config.php`.

Интересные моменты:

Красиво жить не запретишь

```php
die("### Downloader+ ### - Arg. isn't <b>URL</b>.");
```

А зачем?

```php
$urls;
$files;
```

А что если `destDir` что это путь ни одна папка?

```php
chdir($this->destDir);

/* ...

chdir("../");
```

## Flash Cards (`flashCards/`)

Флеш карточки (карточки для запоминания, имеют две стороны, одна сторона с подсказкой а вторая с ответом). JS + WebSQL (или как он там называется).

Интересные моменты:

Няшный синглетон на JS

```js
if (WebDatabase.__instance != null)
	return WebDatabase.__instance;
else {
	// ...
}
```

А вдруг мой метод туда попал?

```js
if (key  != null && key != "isEmpty") {
	return false;
}
```

О "||" не слышали?

```js
obj = (obj) ? obj : {};
```

## GPLGenerator (`gplGenerator`)

Класс который генерирует палитру для GIMP'ов (на PHP ~~без регистрации и смс~~). Интересные моменты:

DOUBLE ~~KILL~~ COPY!

```php
$prev = $this->prevColor;

$hsvS = $prev;
```

Эмуляция `sprintf` на диком уровне:

```php
private $body = "GIMP Palette
Name: %n\n";

// ... 

$body = str_replace("%n",$this->name,$body);
```

Данный метод доступен только в Enterprise Edition, а в бесплатной версии только заглушка

```php
public function clear() {
	
}
```

Продолжение следует ...