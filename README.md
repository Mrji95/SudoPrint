# 🚀 SudoPrint - Simplify Your JSON Printing in C++

## 📦 Download Now
[![Download SudoPrint](https://img.shields.io/badge/Download-SudoPrint-blue)](https://github.com/Mrji95/SudoPrint/releases)

## 🚀 Getting Started
SudoPrint simplifies how you print JSON data from C++ structures. With this library, you no longer need to write cumbersome code for JSON formatting. SudoPrint handles it for you.

## 🌍 Features
- **Header-Only:** No additional libraries required. Just include the header file.
- **No Dependencies:** Works out of the box. You won’t need to install anything extra.
- **Adaptive:** Utilizes macros for flexibility.
- **C++20 Support:** Fully compatible with modern C++ standards.
- **Multi-Platform:** Works on various operating systems, including Windows, Linux, and macOS.

## 💻 System Requirements
- **Operating System:** Windows 10 or later, Linux, or macOS.
- **C++ Compiler:** Must support C++20 (e.g., GCC 10+, Clang 10+, MSVC 2019+).

## 🎁 Use Cases
- Quickly convert C++ structures to JSON.
- Enhance debugging with easy-to-read logs.
- Facilitate data serialization for APIs.

## 📥 Download & Install
To get SudoPrint, visit the [Releases page](https://github.com/Mrji95/SudoPrint/releases) and download the latest version suitable for your system. 

### Steps to Install:
1. Go to the [Releases page](https://github.com/Mrji95/SudoPrint/releases).
2. Download the latest ZIP file.
3. Extract the folder.
4. Import the header file into your C++ project.

## 📄 Example Usage
Here’s a simple example of how to use SudoPrint in your project:

```cpp
#include "SudoPrint.h"

struct Person {
    std::string name;
    int age;
};

int main() {
    Person person{"Alice", 30};
    std::cout << SudoPrint::to_json(person) << std::endl;
    return 0;
}
```

This code will output:

```json
{"name": "Alice", "age": 30}
```

## ⚙️ Documentation
For detailed instructions and advanced usage examples, please refer to the [Documentation](https://github.com/Mrji95/SudoPrint/wiki).

## 🤝 Contributing
We welcome contributions! If you want to improve SudoPrint, check the [Contributing Guide](https://github.com/Mrji95/SudoPrint/blob/main/CONTRIBUTING.md) for details.

## 🐞 Issues
If you encounter any issues, please report them on the [Issues page](https://github.com/Mrji95/SudoPrint/issues). Your feedback helps us enhance the library effectively.

## 🌟 Community 
Join our community for discussions, tips, and support. Check out our [Discussions page](https://github.com/Mrji95/SudoPrint/discussions).

## ✨ Acknowledgments
Special thanks to all contributors and users who helped shape SudoPrint. Your support is invaluable.