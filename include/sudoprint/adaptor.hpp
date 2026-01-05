#pragma once
#include <vector>
#include <string>
#include <array>
#include "core/reflector.hpp"

/**
 * @brief Register a struct to enable Key-Value JSON output.
 * @param Type The struct type name.
 * @param ... Member variable names.
 * * Usage: SUDO_ADAPT(MyStruct, name, age, id)
 */
#define SUDO_ADAPT(Type, ...) \
    namespace sudo::core { \
        template<> struct adaptor_traits<Type> { \
            static constexpr bool has_names = true; \
            static constexpr auto raw_str = #__VA_ARGS__; \
            /* Runtime string parsing to extract variable names */ \
            static const char* get_name(size_t index) { \
                static std::vector<std::string> names; \
                if (names.empty()) { \
                    std::string s = raw_str; \
                    size_t pos = 0; \
                    while ((pos = s.find(",")) != std::string::npos) { \
                        std::string t = s.substr(0, pos); \
                        size_t start = t.find_first_not_of(" "); \
                        if (start != std::string::npos) t = t.substr(start); \
                        names.push_back(t); \
                        s.erase(0, pos + 1); \
                    } \
                    size_t start = s.find_first_not_of(" "); \
                    if (start != std::string::npos) s = s.substr(start); \
                    names.push_back(s); \
                } \
                return (index < names.size()) ? names[index].c_str() : ""; \
            } \
        }; \
    }