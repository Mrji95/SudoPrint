#pragma once
#include <iostream>
#include "sudoprint/core/reflector.hpp"
#include "sudoprint/format/printer.hpp"
#include "sudoprint/adaptor.hpp" 

namespace sudo {
    
    /**
     * @brief Prints any struct, class, or container.
     * * Adaptive Behavior:
     * 1. If SUDO_ADAPT macro is used: Output JSON with keys.
     * 2. If on macOS (Clang): Output detailed struct dump.
     * 3. Fallback: Output JSON-style values array.
     */
    template <typename T>
    void print(const T& obj) {
        format::Printer printer(std::cout, 0);
        printer(obj);
        std::cout << "\n";
    }

} // namespace sudo