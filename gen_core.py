import sys
import os

def generate():
    max_members = 100
    
    # Ensure directory exists
    os.makedirs("include/sudoprint/core", exist_ok=True)
    
    code = r"""#pragma once
#include <tuple>
#include <type_traits>
#include <utility>

namespace sudo::core {
    // 1. SFINAE Helper for Macro Detection
    template <typename T>
    struct adaptor_traits {
        static constexpr bool has_names = false;
        // Default dummy implementation to prevent compilation errors
        static const char* get_name(size_t) { return ""; } 
    };

    // 2. Member Counter (Support 0-100 members)
    // Uses "Universal Type" implicitly convertible to anything
    struct UniversalType { template <typename T> operator T() const { return {}; } };
    
    template <typename T>
    consteval size_t member_count() {
        UniversalType u;
"""
    # Generate detection logic
    for i in range(max_members, -1, -1):
        args = ",".join(["u"] * i)
        if i == 0:
            code += "        return 0;\n"
        else:
            code += f"        if constexpr (requires {{ T{{{args}}}; }}) return {i};\n"

    code += r"""    }

    // 3. Struct to Tuple Conversion (Reflection Magic)
    template <typename T>
    concept IsAggregate = std::is_aggregate_v<T> && !std::is_scalar_v<T>;

    template <IsAggregate T>
    auto struct_to_tuple(const T& obj) {
        constexpr size_t Count = member_count<T>();
        if constexpr (Count == 0) return std::make_tuple();
"""
    # Generate bindings
    for i in range(1, max_members + 1):
        bindings = ",".join([f"p{k}" for k in range(1, i + 1)])
        code += f"        else if constexpr (Count == {i}) {{ auto& [{bindings}] = obj; return std::tie({bindings}); }}\n"

    code += r"""        else return std::make_tuple();
    }
}
"""
    return code

if __name__ == "__main__":
    with open("include/sudoprint/core/reflector.hpp", "w") as f:
        f.write(generate())
    print("Success: Generated include/sudoprint/core/reflector.hpp with English comments.")