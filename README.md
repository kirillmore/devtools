# devtools
Быстрая загрузка кода и правок на продакшн.

![window](/img/window.png)
## 0. Init
1. Put folder "_devtools" in your projects root.
2. Create project folder and ```git init```.
3. Create version.txt file with content ```v0.1```, where 0.1 is your current wersion.
4. Edit file ```.git/config```. Add:
```
[git-ftp "prod"]
  user = %user%
  url = %path%
  password = %password%
```
5. Make first commit and run command
```git ftp -s prod cathup```

## 1. Usage
Add this line to index.php file:
```
<?if($_SERVER['SERVER_NAME']=='localhost') echo'<script id="moredev" src="../_devtools/moreDev.js?path='.$current_page=str_replace("/","",strtolower(parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",PHP_URL_PATH))).'"></script>';?>

```