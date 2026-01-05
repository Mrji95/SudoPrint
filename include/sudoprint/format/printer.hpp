#pragma once
#include <iostream>
#include <vector>
#include <string>
#include <tuple>
#include <cstdio>
#include "../core/reflector.hpp"
#include "../adaptor.hpp" 

namespace sudo::format {
    
    namespace color {
        const std::string RESET   = "\033[0m";
        const std::string KEY     = "\033[34m"; // Blue
        const std::string STR     = "\033[32m"; // Green
        const std::string NUM     = "\033[36m"; // Cyan
        const std::string SYM     = "\033[90m"; // Gray
        const std::string MAC     = "\033[35m"; // Purple (Mac Magic)
    }

    class Printer {
        std::ostream& os_;
        int level_;

    public:
        Printer(std::ostream& os, int level) : os_(os), level_(level) {}

        void indent() {
            os_ << "\n";
            for(int i=0; i<level_; ++i) os_ << "  ";
        }

        // --- Basic Types ---
        template <typename T>
        void operator()(const T& val) {
            if constexpr (std::is_arithmetic_v<T>) os_ << color::NUM << val << color::RESET;
            else os_ << val;
        }
        void operator()(const std::string& val) { os_ << color::STR << "\"" << val << "\"" << color::RESET; }
        void operator()(const char* val) { os_ << color::STR << "\"" << val << "\"" << color::RESET; }

        // --- Containers ---
        template <typename T>
        requires (requires(T t) { std::begin(t); end(t); }) && (!std::is_same_v<T, std::string>)
        void operator()(const T& c) {
            if (std::empty(c)) { os_ << "[]"; return; }
            os_ << "[";
            bool first = true;
            Printer sub(os_, level_ + 1);
            for (const auto& i : c) {
                if (!first) os_ << ", ";
                if (first) sub.indent(); else sub.indent();
                sub(i);
                first = false;
            }
            indent(); os_ << "]";
        }

        // --- Structs (Core Routing Logic) ---
        template <core::IsAggregate T>
        void operator()(const T& obj) {
            
            // 1. Priority 1: If macro is defined, use perfect JSON format.
            constexpr bool has_macros = core::adaptor_traits<T>::has_names;
            
            if constexpr (has_macros) {
                print_with_macros(obj);
                return;
            }

            // 2. Priority 2: If no macro, but compiler supports built-in Dump (Mac/Clang).
            // Note: This outputs C-style struct format with variable names.
#ifdef __clang__
            // Compile-time check: Only Clang compiles this block.
            os_ << color::MAC; // Mark this as Mac Magic output.
            // Flush buffer to prevent output ordering issues.
            os_.flush(); 
            // Call built-in function, prints directly to stdout (printf).
            __builtin_dump_struct(&obj, &printf);
            os_ << color::RESET;
            return;
#else
            // 3. Priority 3: Fallback, output JSON value list.
            print_fallback(obj);
#endif
        }

    private:
        // Mode A: Perfect JSON with Macro Support.
        template <typename T>
        void print_with_macros(const T& obj) {
            auto tuple = core::struct_to_tuple(obj);
            if (std::tuple_size_v<decltype(tuple)> == 0) { os_ << "{}"; return; }

            os_ << color::SYM << "{" << color::RESET;
            Printer sub(os_, level_ + 1);
            
            std::apply([&](auto&&... args) {
                size_t n = 0;
                ((
                    (n++ ? (os_ << ", ") : os_),
                    sub.indent(),
                    // Names are guaranteed, print Key directly.
                    (os_ << color::KEY << "\"" << core::adaptor_traits<T>::get_name(n-1) << "\": " << color::RESET),
                    sub(args)
                ), ...);
            }, tuple);

            indent(); os_ << color::SYM << "}" << color::RESET;
        }

        // Mode B: Fallback JSON (No Keys).
        template <typename T>
        void print_fallback(const T& obj) {
            auto tuple = core::struct_to_tuple(obj);
            if (std::tuple_size_v<decltype(tuple)> == 0) { os_ << "{}"; return; }

            os_ << color::SYM << "{" << color::RESET; // Still use braces to indicate it's an Object.
            Printer sub(os_, level_ + 1);

            std::apply([&](auto&&... args) {
                size_t n = 0;
                ((
                    (n++ ? (os_ << ", ") : os_),
                    sub.indent(),
                    // No names available, print values only.
                    sub(args)
                ), ...);
            }, tuple);
            
            indent(); os_ << color::SYM << "}" << color::RESET;
        }
    };
}