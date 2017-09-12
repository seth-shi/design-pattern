# WaitMoonMan/design-pattern 

## 单例模式


## Feature
 * 通过对象中的属性中保存一个静态实例
 
 
## Expound
* 单例类中通常会有一个静态属性保存自身实例
* 特殊的方法**私有**
    * `__construct` 防止在外部实例化对象
    * `__clone`     防止在外部克隆对象
    * `____wakeup`  防止在外部反序列化对象
* 通过打印输出，我们可以看到在`class Singleton`后面都有一个`#1`,`#`后面的数字代表整个程序中第几个实例化的对象。两个都是`1`代表整个程序中只实例化了一次对象，这就是单例的由来。
```php
F:\phpStudy\WWW\designPattern\Singleton\index.php:60:
class Singleton#1 (0) {
}
F:\phpStudy\WWW\designPattern\Singleton\index.php:60:
class Singleton#1 (0) {
}
```