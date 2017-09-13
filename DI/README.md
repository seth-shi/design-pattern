# WaitMoonMan/design-pattern 

## 依赖注入


## Feature
* `Laravel`是这样定义依赖注入的：
> 依赖注入这个花俏名词实质上是指：类的依赖项通过构造函数，或者某些情况下通过「setter」方法「注入」到类中。
* 不要在类中内部直接实例化对象，而是通过注入对象来解决程序的耦合
 
 
## Expound
* 减少程序的耦合，不在内部依赖，转为外部提供，当依赖类变化时，不需要修改本类。
* 定义一个接口`DataBaseInterface`，在`DB`类注入参数时填上参数类型限制，这就限定了参数只能是实现了`DataBaseInterface`这个接口的类的实例
* 接口中定义`query`方法，就可以在`DB`类中放心的使用`query`方法