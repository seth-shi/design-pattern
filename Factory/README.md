# WaitMoonMan/design-pattern 

## 工厂模式


## Feature
 * 因为工厂中有简单工厂，工厂方法，抽象工厂，这里着重讲解思想，不区分。
 
 
## Expound
* 需要用到的对象不需要`new`,而是通过工厂获取实例
* 程序外部并没有调用`new`关键字,但打印的却已经有了三个对象的类型
```php
F:\phpStudy\WWW\designPattern\Factory\index.php:48:
class A#1 (0) {
}
F:\phpStudy\WWW\designPattern\Factory\index.php:48:
class B#2 (0) {
}
F:\phpStudy\WWW\designPattern\Factory\index.php:48:
class C#3 (0) {
}
```