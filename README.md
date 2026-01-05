# SudoPrint 🚀

> **Header-only, Zero-dependency, Adaptive C++20 Reflection Library.** > 零依赖、开箱即用、自适应的 C++20 反射打印库。

![C++20](https://img.shields.io/badge/Standard-C%2B%2B20-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)
![Platform](https://img.shields.io/badge/Platform-Linux%20%7C%20macOS%20%7C%20Windows-lightgrey)

## ✨ Features / 特性

SudoPrint is designed for developers who hate writing `operator<<` for every struct.  
SudoPrint 专为那些不想给每个结构体手写 `operator<<` 的开发者设计。

* **⚡️ Zero Boilerplate**: Just `#include <sudoprint.hpp>` and `sudo::print(obj)`.
    * **零样板代码**：引入头文件即可直接打印任意结构体。
* **🧠 Adaptive Output (自适应输出)**:
    * **Advanced**: Uses Macro metadata to print perfect JSON `{ "key": value }`. (宏支持：完美 JSON 键值对)
    * **Mac Magic**: Uses Clang's `__builtin_dump_struct` automatically on macOS. (Mac 魔法：自动利用编译器特性打印变量名)
    * **Fallback**: Gracefully degrades to `[value1, value2]` if no info provided. (自动降级：无元数据时自动打印值列表)
* **🎨 Pretty Print**: JSON-style indentation and **ANSI Colors**.
    * **高颜值**：JSON 风格缩进，支持 ANSI 彩色高亮。
* **💪 Heavy Duty**: Supports structs with up to **100 members**.
    * **工业级**：支持包含 100 个成员变量的大型结构体。

## 📦 Installation / 安装

SudoPrint is **header-only**.  
SudoPrint 是 **Header-only** 的库，不需要编译。

1.  Copy the `include` folder to your project. (将 `include` 文件夹复制到你的项目中)
2.  Add to `CMakeLists.txt`:

```cmake
# Assuming you copied the library to 'libs/SudoPrint'
add_subdirectory(libs/SudoPrint)
target_link_libraries(your_target PRIVATE sudoprint)
```

## 🚀 Usage / 使用指南

### 1. Basic Usage (Zero Config)
**Scenario**: You want to check values quickly.  
**场景**：懒人模式，只想快速看数值。

```cpp
#include <sudoprint.hpp>

struct User {
    std::string name;
    int age;
};

int main() {
    User u = {"Sudo", 21};
    
    // Output: { "Sudo", 21 } (Values only)
    // On macOS(Clang): struct User { name = "Sudo", age = 21 }
    sudo::print(u); 
}
```

### 2. Advanced Usage (With Keys)
**Scenario**: You want standard JSON output with field names.  
**场景**：需要完美的 JSON 格式（带字段名）。

```cpp
#include <sudoprint.hpp>

struct Config {
    std::string host;
    int port;
    std::vector<int> ids;
};

// Register once, benefit everywhere!
SUDO_ADAPT(Config, host, port, ids)

int main() {
    Config c = {"localhost", 8080, {1, 2, 3}};
    
    // Output: 
    // {
    //   "host": "localhost",
    //   "port": 8080,
    //   "ids": [1, 2, 3]
    // }
    sudo::print(c);
}
```

### 3. Container Support
**Scenario**: Print `std::vector` or nested structs.  
**场景**：打印容器或嵌套结构体。

```cpp
std::vector<User> users = {{"Alice", 20}, {"Bob", 22}};
sudo::print(users); 
// Output: [ { "Alice", 20 }, { "Bob", 22 } ]
```

## 🛠 Requirements / 环境要求

* **C++20 Compiler** (GCC 10+, Clang 10+, MSVC 19.29+)
* **CMake 3.20+**

## 📄 License & Copyright

This project is licensed under the **MIT License**.  
Free to use, modify, and distribute, as long as the original author is credited.

Copyright © 2026 **[Your Name]**. All rights reserved.